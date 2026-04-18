<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 10);          // en, ja, ko, zh, ar
            $table->string('group', 100);           // products, pages, ui, blog
            $table->string('key')->index();         // product.name, hero.title, dll
            $table->longText('value');              // Hasil terjemahan
            $table->timestamps();

            $table->unique(['locale', 'group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
