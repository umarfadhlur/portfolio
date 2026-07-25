<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('category')->nullable();
            $table->string('certifications')->nullable();

            // Nutrition Facts
            $table->string('serving_size')->nullable();
            $table->integer('serving_per_container')->nullable();
            $table->integer('calories')->nullable();
            $table->integer('calories_from_fat')->nullable();
            $table->decimal('total_fat', 5, 2)->nullable();
            $table->decimal('saturated_fat', 5, 2)->nullable();
            $table->decimal('trans_fat', 5, 2)->nullable();
            $table->integer('cholesterol')->nullable();
            $table->integer('sodium')->nullable();
            $table->decimal('total_carbohydrate', 5, 2)->nullable();
            $table->decimal('dietary_fiber', 5, 2)->nullable();
            $table->decimal('sugars', 5, 2)->nullable();
            $table->decimal('protein', 5, 2)->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
