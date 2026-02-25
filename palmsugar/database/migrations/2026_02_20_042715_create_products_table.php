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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama produk (Palm Sugar)
        $table->string('slug')->unique(); // URL ramah SEO
        $table->string('thumbnail')->nullable(); // Gambar kecil untuk list
        $table->text('short_description')->nullable(); // Deskripsi singkat di card
        $table->longText('description')->nullable(); // Deskripsi lengkap (Halaman detail)
        $table->json('specifications')->nullable(); // Spesifikasi teknis (JSON: Moisture, Ash, etc)
        $table->string('brochure_file')->nullable(); // File PDF brosur (opsional)
        $table->boolean('is_featured')->default(false); // Tampilkan di homepage?
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
