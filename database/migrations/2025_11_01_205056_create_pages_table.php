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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Multilingue
            $table->string('slug')->unique();
            $table->json('content'); // Multilingue - contenu HTML
            $table->string('template')->default('default'); // template à utiliser
            $table->json('meta_title')->nullable(); // SEO multilingue
            $table->json('meta_description')->nullable(); // SEO multilingue
            $table->boolean('is_published')->default(false);
            $table->boolean('show_in_menu')->default(false);
            $table->integer('menu_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
