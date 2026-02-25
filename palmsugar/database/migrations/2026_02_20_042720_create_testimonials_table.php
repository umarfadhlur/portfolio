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
    Schema::create('testimonials', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nama klien
        $table->string('company')->nullable(); // Nama perusahaan klien
        $table->string('role')->nullable(); // Jabatan (CEO, Procurement Manager)
        $table->text('content'); // Isi testimoni
        $table->string('avatar')->nullable(); // Foto profil klien
        $table->integer('rating')->default(5); // Bintang 1-5
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
