<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->constrained()->onDelete('cascade');
            $table->string('parameter_type');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('secondary_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('text_color')->nullable();
            $table->string('font_family')->nullable();
            $table->string('font_size')->nullable();
            $table->string('logo_position')->nullable();
            $table->string('menu_layout')->nullable();
            $table->string('button_style')->nullable();
            $table->string('theme_mode')->default('light'); // 'light' or 'dark'
            $table->json('custom_css')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameters');
    }
};
