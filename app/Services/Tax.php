<?php

namespace App\Services;

use App\Models\{Cart, CustomerAddress, InvoiceSetting, Product, TaxClass};

class Tax
{
    private static ?InvoiceSetting $setting = null;
    private static $default = false;

    /** Clear per-process caches (queue workers, after saving settings / tax classes). */
    public static function flush(): void
    {
        self::$setting = null;
        self::$default = false;
    }

    private static function setting(): ?InvoiceSetting
    {
        return self::$setting ??= InvoiceSetting::first();
    }

    public static function enabled(): bool
    {
        return (bool) (self::setting()?->gst_enabled);
    }

    public static function inclusive(): bool
    {
        return (self::setting()?->tax_type ?? 'inclusive') === 'inclusive';
    }

    /** product class -> subcategory class -> category class -> default class -> 0 */
    public static function rateFor(?Product $product): float
    {
        if (!$product || !self::enabled()) {
            return 0.0;
        }

        $product->loadMissing('taxClass', 'subcategory.taxClass', 'category.taxClass');

        $class = collect([$product->taxClass, $product->subcategory?->taxClass, $product->category?->taxClass])
            ->first(fn($c) => $c && $c->status);

        if (self::$default === false) {
            self::$default = TaxClass::where('is_default', true)->where('status', true)->first();
        }

        return (float) ($class?->rate ?? self::$default?->rate ?? 0);
    }

    /**
     * Customer in the company's state => CGST + SGST, otherwise IGST.
     * Guest, customer without a default address, or company state not set => CGST + SGST.
     */
    public static function sameState(Cart $cart): bool
    {
        $companyState = self::setting()?->company_state;

        if (!$cart->customer_id || !$companyState) {
            return true;
        }

        $address = CustomerAddress::where('customer_id', $cart->customer_id)->where('is_default', 1)->first();

        if (!$address) {
            return true;
        }

        return (int) $address->state_id === (int) $companyState;
    }

    /**
     * Tax for a whole cart, line by line. The coupon discount is shared across lines
     * in proportion to their value, so each line is taxed on what the customer really pays.
     */
    public static function forCart(Cart $cart, float $discount = 0): array
    {
        $out = [
            'type' => null, 'lines' => [],
            'tax' => 0.0, 'cgst' => 0.0, 'sgst' => 0.0, 'igst' => 0.0,
            'cgst_rate' => 0.0, 'sgst_rate' => 0.0, 'igst_rate' => 0.0,
        ];

        if (!self::enabled()) {
            return $out;
        }

        $items = $cart->items()
            ->with(['product.taxClass', 'product.subcategory.taxClass', 'product.category.taxClass'])
            ->get();

        $subtotal = (float) $items->sum('total');
        if ($subtotal <= 0) {
            return $out;
        }

        $inclusive = self::inclusive();
        $same = self::sameState($cart);
        $totalTax = 0.0;
        $totalBase = 0.0;

        foreach ($items as $item) {
            $rate = self::rateFor($item->product);
            $share = $discount > 0 ? $discount * ((float) $item->total / $subtotal) : 0;
            $gross = max((float) $item->total - $share, 0);

            $tax = $rate > 0
                ? ($inclusive ? $gross * $rate / (100 + $rate) : $gross * $rate / 100)
                : 0;
            $tax = round($tax, 2);

            $out['lines'][$item->id] = ['rate' => $rate, 'tax' => $tax];
            $totalTax += $tax;
            $totalBase += $inclusive ? $gross - $tax : $gross;
        }

        $totalTax = round($totalTax, 2);
        $effective = $totalBase > 0 ? round($totalTax / $totalBase * 100, 2) : 0;

        $out['type'] = $same ? 'cgst_sgst' : 'igst';
        $out['tax'] = $totalTax;

        if ($same) {
            $half = round($totalTax / 2, 2);
            $out['cgst'] = $half;
            $out['sgst'] = round($totalTax - $half, 2);   // keeps CGST + SGST == total tax to the paisa
            $out['cgst_rate'] = $out['sgst_rate'] = round($effective / 2, 2);
        } else {
            $out['igst'] = $totalTax;
            $out['igst_rate'] = $effective;
        }

        return $out;
    }
}