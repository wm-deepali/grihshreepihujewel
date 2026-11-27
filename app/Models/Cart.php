<?php

namespace App\Models;
use App\Services\Tax;
use App\Services\ShippingCalculator;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [

        'customer_id',
        'session_id',

        'total_amount',

        'coupon_id',
        'coupon_code',

        'subtotal',
        'discount',
        'tax_amount',
        'shipping_charge',

        'gst_type',

        'cgst_rate',
        'sgst_rate',
        'igst_rate',

        'cgst_amount',
        'sgst_amount',
        'igst_amount',

        'grand_total',
    ];

    public function items()
    {
        return $this->hasMany(
            CartItem::class
        );
    }

    public function customer()
    {
        return $this->belongsTo(
            Customer::class
        );
    }

    public function coupon()
    {
        return $this->belongsTo(
            Coupon::class
        );
    }

    public function recalculateTotals()
    {
        $subtotal = (float) $this->items()->sum('total');
        $discount = (float) ($this->discount ?? 0);
        $taxableAmount = max($subtotal - $discount, 0);

        // per-line GST from tax classes (all zeros / null when GST is switched off)
        $tax = Tax::forCart($this, $discount);
        $taxAmount = $tax['tax'];

        if ($taxAmount > 0 && !Tax::inclusive()) {
            $grandTotal = $taxableAmount + $taxAmount;   // GST added on top
            $displaySubtotal = $subtotal;
        } elseif ($taxAmount > 0) {
            $grandTotal = $taxableAmount;                // prices already include GST
            $displaySubtotal = $subtotal - $taxAmount;
        } else {
            $grandTotal = $taxableAmount;
            $displaySubtotal = $subtotal;
        }

        // snapshot each line's rate (the order copies this when it is placed)
        foreach ($tax['lines'] as $itemId => $line) {
            CartItem::where('id', $itemId)
                ->where(fn($q) => $q->whereNull('tax_rate')->orWhere('tax_rate', '!=', $line['rate']))
                ->update(['tax_rate' => $line['rate']]);
        }
        if (!$tax['lines']) {
            $this->items()
                ->where(fn($q) => $q->whereNull('tax_rate')->orWhere('tax_rate', '!=', 0))
                ->update(['tax_rate' => 0]);
        }

        // Shipping: on top of the payable amount, not taxed. Unknown zone
        // (guest / no default address) adds nothing yet; empty cart adds nothing.
        $shippingCharge = 0;

        if ($subtotal > 0) {
            $shipping = ShippingCalculator::forCart($this, (float) $taxableAmount);
            $shippingCharge = $shipping['known'] ? $shipping['charge'] : 0;
        }

        $this->update([
            'subtotal' => round($displaySubtotal, 2),
            'discount' => round($discount, 2),

            'gst_type' => $tax['type'],

            'cgst_rate' => $tax['cgst_rate'],
            'sgst_rate' => $tax['sgst_rate'],
            'igst_rate' => $tax['igst_rate'],

            'cgst_amount' => $tax['cgst'],
            'sgst_amount' => $tax['sgst'],
            'igst_amount' => $tax['igst'],

            'tax_amount' => round($taxAmount, 2),
            'shipping_charge' => round($shippingCharge, 2),

            'grand_total' => round($grandTotal + $shippingCharge, 2),
            'total_amount' => round($grandTotal, 2), // before shipping
        ]);
    }

}