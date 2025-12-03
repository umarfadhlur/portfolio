<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitation_settings', function (Blueprint $table) {
            $table->id();
            $table->string('bride_name');
            $table->string('groom_name');
            $table->date('wedding_date');
            $table->time('akad_time');
            $table->time('resepsi_time');
            $table->string('akad_location');
            $table->text('akad_address');
            $table->string('akad_map_link')->nullable();
            $table->string('resepsi_location');
            $table->text('resepsi_address');
            $table->string('resepsi_map_link')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('music_file')->nullable();
            $table->string('theme_primary_color')->default('#C7D3C0');
            $table->string('theme_secondary_color')->default('#C0C0C0');
            $table->string('qris_image')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitation_settings');
    }
};