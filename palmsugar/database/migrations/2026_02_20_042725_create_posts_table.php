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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul artikel
        $table->string('slug')->unique(); // URL
        $table->string('thumbnail')->nullable(); // Gambar utama
        $table->longText('content'); // Isi artikel (Rich Text)
        $table->date('published_at')->nullable(); // Tanggal terbit
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Penulis
        $table->boolean('is_published')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
