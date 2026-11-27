<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceSetting;
use App\Models\Order;
use App\Http\Controllers\Admin\AdminSettingController;
use Illuminate\Support\Facades\Schema;

class InvoiceService
{
    public function autoEnabled(): bool
    {
        $setting = InvoiceSetting::first();

        return $setting ? (bool) $setting->auto_generate_invoice : true;
    }

    public function createIfAuto(Order $order): ?Invoice
    {
        return $this->autoEnabled() ? $this->createForOrder($order) : null;
    }

    public function createForOrder(Order $order): Invoice
    {
        if ($existing = Invoice::where('order_id', $order->id)->first()) {
            return $existing;
        }

        $order->loadMissing(['city', 'state']);

        if ($order->billing_address_line_1) {
            $bState = \App\Models\State::find($order->billing_state_id)?->name;
            $bCity = \App\Models\City::find($order->billing_city_id)?->name;

            $billingAddress = collect([
                $order->billing_address_line_1,
                $order->billing_address_line_2,
                $bCity,
                $bState,
                $order->billing_pincode,
            ])->filter()->implode(', ');
        } else { // orders placed before billing existed
            $billingAddress = collect([
                $order->address_line_1,
                $order->address_line_2,
                $order->city?->name,
                $order->state?->name,
                $order->pincode,
            ])->filter()->implode(', ');
        }

        // GST switched off when the order was placed => no GST fields on the invoice at all
        $gstApplied = (float) $order->tax_amount > 0 && !empty($order->gst_type);

        $data = [
            'order_id' => $order->id,
            'invoice_number' => AdminSettingController::generateInvoiceNumber(),
            'invoice_date' => now()->toDateString(),

            'customer_name' => $order->billing_name ?: $order->customer_name,
            'customer_email' => $order->customer_email,
            'customer_phone' => $order->customer_phone,
            'billing_address' => $billingAddress,

            'subtotal' => $order->subtotal,
            'discount' => $order->discount,
            'tax_amount' => $gstApplied ? $order->tax_amount : 0,
            'grand_total' => $order->grand_total,

            'gst_type' => $gstApplied ? $order->gst_type : null,
            'cgst_rate' => $gstApplied ? $order->cgst_rate : null,
            'sgst_rate' => $gstApplied ? $order->sgst_rate : null,
            'igst_rate' => $gstApplied ? $order->igst_rate : null,
            'cgst_amount' => $gstApplied ? $order->cgst_amount : null,
            'sgst_amount' => $gstApplied ? $order->sgst_amount : null,
            'igst_amount' => $gstApplied ? $order->igst_amount : null,

            'status' => 'generated',
        ];

        // Shipping sirf un projects me jahan dono tables me column hai
        if (Schema::hasColumn('orders', 'shipping_charge') && Schema::hasColumn('invoices', 'shipping_charge')) {
            $data['shipping_charge'] = $order->shipping_charge;
        }

        // Snapshot of inclusive/exclusive as it was when the order was placed
        if (Schema::hasColumn('orders', 'tax_inclusive') && Schema::hasColumn('invoices', 'tax_inclusive')) {
            $data['tax_inclusive'] = $order->tax_inclusive;
        }

        return Invoice::create($data);
    }
}