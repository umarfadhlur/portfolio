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
    Schema::create('sliders', function (Blueprint $table) {
        $table->id();
        $table->string('headline'); // Judul besar
        $table->text('subheadline')->nullable(); // Deskripsi di bawah judul
        $table->string('image'); // Gambar background
        $table->string('cta_text')->nullable(); // Teks tombol (misal: Contact Us)
        $table->string('cta_url')->nullable(); // Link tombol
        $table->integer('order')->default(0); // Urutan tampil
        $table->boolean('is_active')->default(true); // Tampilkan/Sembunyikan
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
