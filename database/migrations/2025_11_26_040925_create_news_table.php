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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul berita
            $table->text('content'); // Isi berita
            $table->string('image')->nullable(); // Path gambar berita
            $table->string('category')->nullable(); // Kategori berita
            $table->string('tags')->nullable(); // Tag berita (bisa comma separated)
            $table->dateTime('published_at')->nullable(); // Tanggal publish
            $table->boolean('is_active')->default(true); // Status aktif/tidak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
