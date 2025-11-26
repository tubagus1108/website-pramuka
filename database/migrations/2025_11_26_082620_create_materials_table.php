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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('content');
            $table->string('category'); // Siaga, Penggalang, Penegak, Pandega, Umum
            $table->string('level')->nullable(); // Dasar, Lanjutan, Mahir
            $table->string('image')->nullable();
            $table->string('file_attachment')->nullable(); // PDF, DOC, etc
            $table->string('tags')->nullable();
            $table->string('author')->nullable();
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
