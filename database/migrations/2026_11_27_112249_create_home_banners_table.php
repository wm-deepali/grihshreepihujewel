<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_banners', function (Blueprint $t) {
            $t->id();
            $t->string('eyebrow')->nullable();
            $t->string('title');                       // Enter = line break on the site
            $t->text('description')->nullable();
            $t->string('image');                       // desktop image
            $t->string('mobile_image')->nullable();    // optional, falls back to image

            $t->string('button_1_text')->nullable();   // filled white button
            $t->string('button_1_url')->nullable();
            $t->string('button_2_text')->nullable();   // outline button
            $t->string('button_2_url')->nullable();

            $t->unsignedInteger('sort_order')->default(0);
            $t->boolean('status')->default(true);
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_banners');
    }
};