<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('headline')->nullable();
            $table->text('description')->nullable();
            $table->string('logo_light_theme_url')->nullable();
            $table->string('logo_dark_theme_url')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('google_maps_link')->nullable();
            $table->json('opening_hours')->nullable();
            $table->json('social_links')->nullable();
            $table->string('currency')->default('DH');
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
