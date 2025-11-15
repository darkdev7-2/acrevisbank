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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Job title
            $table->string('slug')->unique();
            $table->string('location'); // City/Office location
            $table->string('department'); // HR, IT, Finance, etc.
            $table->string('contract_type'); // CDI, CDD, Stage, Apprentissage
            $table->string('workload'); // 100%, 80%, etc.
            $table->text('description'); // Job description (JSON for multilingual)
            $table->text('requirements'); // Job requirements (JSON for multilingual)
            $table->text('benefits')->nullable(); // Benefits (JSON for multilingual)
            $table->date('published_at')->nullable();
            $table->date('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
