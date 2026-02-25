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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('key')->unique(); // Misal: site_name, contact_email, footer_text
        $table->text('value')->nullable(); // Isinya
        $table->string('type')->default('text'); // text, image, boolean (buat helper di admin)
        $table->string('group')->default('general'); // general, contact, social
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
