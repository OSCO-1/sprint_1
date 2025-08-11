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

            $table->string('name', 255);
            $table->string('headline', 255)->nullable();
            $table->text('description')->nullable();

            // Logos
            $table->string('logo_light_theme_url', 255)->nullable();
            // Removed logo_dark_theme_url

            $table->string('cover_image_url', 255)->nullable();

            // Contact info
            $table->string('phone_number', 50)->nullable();
            $table->string('phone_fix', 50)->nullable();
            $table->string('gmail', 255)->nullable();

            $table->string('address', 500)->nullable();
            $table->string('google_maps_link', 1000)->nullable();

            // Social media columns instead of JSON
            $table->string('facebook', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->string('snapchat', 255)->nullable();
            $table->string('tiktok', 255)->nullable();

            $table->string('currency', 10)->default('DH');

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
