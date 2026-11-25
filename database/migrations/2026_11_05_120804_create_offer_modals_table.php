<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offer_modals', function (Blueprint $table) {
            $table->id();

            // Content
            $table->string('sub_title')->nullable();          // "Exclusive Offer"
            $table->string('title')->nullable();              // "Welcome to Archana"
            $table->text('short_content')->nullable();        // description paragraph

            // Coupon block
            $table->string('coupon_text')->nullable();        // "Extra 10% Off"
            $table->string('coupon_sub_text')->nullable();    // "on your first order"
            $table->string('coupon_code', 100)->nullable();   // "ARCHANA10" (entered manually)

            // Terms: add-more list, stored as JSON array of strings
            $table->json('terms')->nullable();

            // Image
            $table->string('image')->nullable();

            // Button
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_modals');
    }
};