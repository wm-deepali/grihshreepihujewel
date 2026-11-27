<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('order_items', 'tax_rate')) {
            Schema::table('order_items', fn(Blueprint $t) => $t->decimal('tax_rate', 5, 2)->default(0)->after('total'));
        }
        foreach (['orders', 'invoices'] as $table) {
            if (!Schema::hasColumn($table, 'tax_inclusive')) {
                Schema::table($table, fn(Blueprint $t) => $t->boolean('tax_inclusive')->nullable());
            }
        }
    }

    public function down(): void
    {
        Schema::table('order_items', fn(Blueprint $t) => $t->dropColumn('tax_rate'));
        Schema::table('orders', fn(Blueprint $t) => $t->dropColumn('tax_inclusive'));
        Schema::table('invoices', fn(Blueprint $t) => $t->dropColumn('tax_inclusive'));
    }
};