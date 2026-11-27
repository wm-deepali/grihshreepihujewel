<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('menu_label')->nullable();
            $table->string('menu_title')->nullable();
            $table->string('feature_title')->nullable();
            $table->string('feature_image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('slug')->unique();
            $table->string('logo')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
