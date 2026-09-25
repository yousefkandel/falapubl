<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Titles
            $table->string('title_ar');
            $table->string('title_en')->nullable();

            // Category
            $table->string('category_ar');
            $table->string('category_en')->nullable();

            // Relations
            $table->foreignId('author_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('translator_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Book Information
            $table->year('publication_year')->nullable();
            $table->unsignedSmallInteger('pages_count')->nullable();

            // Descriptions
            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            // Images
            $table->string('image_ar')->nullable();
            $table->string('image_en')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
