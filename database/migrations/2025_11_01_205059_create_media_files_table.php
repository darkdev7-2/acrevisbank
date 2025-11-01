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
        Schema::create('media_files', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Multilingue
            $table->json('description')->nullable(); // Multilingue
            $table->string('filename');
            $table->string('path');
            $table->string('type'); // pdf, image, video, document
            $table->string('mime_type');
            $table->unsignedBigInteger('file_size'); // En bytes
            $table->string('category')->nullable(); // contrat, brochure, guide, etc.
            $table->json('tags')->nullable(); // Tags pour recherche
            $table->boolean('is_public')->default(true);
            $table->integer('downloads')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_files');
    }
};
