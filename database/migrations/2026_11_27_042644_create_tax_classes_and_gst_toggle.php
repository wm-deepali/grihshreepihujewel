<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ---------- 1. tax classes ----------
        if (!Schema::hasTable('tax_classes')) {
            Schema::create('tax_classes', function (Blueprint $t) {
                $t->id();
                $t->string('name', 100);                    // e.g. "GST 5%"
                $t->decimal('rate', 5, 2);                  // total rate; CGST/SGST = rate/2, IGST = rate
                $t->boolean('is_default')->default(false);  // only one default (enforced in controller)
                $t->boolean('status')->default(true);
                $t->timestamps();
            });

            // starter classes; change or delete them from the admin page
            $now = now();
            DB::table('tax_classes')->insert([
                ['name' => 'GST 0%',  'rate' => 0,  'is_default' => false, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'GST 5%',  'rate' => 5,  'is_default' => false, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'GST 12%', 'rate' => 12, 'is_default' => false, 'status' => true, 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'GST 18%', 'rate' => 18, 'is_default' => true,  'status' => true, 'created_at' => $now, 'updated_at' => $now],
            ]);
        }

        // ---------- 2. category / product -> tax class ----------
        foreach (['categories', 'products'] as $table) {
            if (Schema::hasTable($table) && !Schema::hasColumn($table, 'tax_class_id')) {
                Schema::table($table, function (Blueprint $t) {
                    $t->foreignId('tax_class_id')->nullable()
                        ->constrained('tax_classes')->nullOnDelete();
                });
            }
        }

        // ---------- 3. master GST switch ----------
        if (Schema::hasTable('invoice_settings') && !Schema::hasColumn('invoice_settings', 'gst_enabled')) {
            Schema::table('invoice_settings', function (Blueprint $t) {
                $t->boolean('gst_enabled')->default(true)->after('business_type');
            });

            // keep existing behaviour: unregistered businesses start with GST off
            DB::table('invoice_settings')
                ->where('business_type', 'unregistered')
                ->update(['gst_enabled' => false]);
        }

        // ---------- 4. tax snapshots (old invoices never change when a rate changes) ----------
        if (Schema::hasTable('cart_items') && !Schema::hasColumn('cart_items', 'tax_rate')) {
            Schema::table('cart_items', function (Blueprint $t) {
                $t->decimal('tax_rate', 5, 2)->default(0);
            });
        }

        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $t) {
                if (!Schema::hasColumn('order_items', 'tax_rate')) {
                    $t->decimal('tax_rate', 5, 2)->default(0);
                }
                if (!Schema::hasColumn('order_items', 'tax_amount')) {
                    $t->decimal('tax_amount', 12, 2)->default(0);
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('order_items')) {
            Schema::table('order_items', function (Blueprint $t) {
                foreach (['tax_rate', 'tax_amount'] as $col) {
                    if (Schema::hasColumn('order_items', $col)) {
                        $t->dropColumn($col);
                    }
                }
            });
        }

        if (Schema::hasTable('cart_items') && Schema::hasColumn('cart_items', 'tax_rate')) {
            Schema::table('cart_items', fn(Blueprint $t) => $t->dropColumn('tax_rate'));
        }

        if (Schema::hasTable('invoice_settings') && Schema::hasColumn('invoice_settings', 'gst_enabled')) {
            Schema::table('invoice_settings', fn(Blueprint $t) => $t->dropColumn('gst_enabled'));
        }

        foreach (['products', 'categories'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'tax_class_id')) {
                Schema::table($table, function (Blueprint $t) use ($table) {
                    $t->dropForeign([ 'tax_class_id' ]);
                    $t->dropColumn('tax_class_id');
                });
            }
        }

        Schema::dropIfExists('tax_classes');
    }
};