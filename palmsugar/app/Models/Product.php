<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'certifications',
        'serving_size',
        'serving_per_container',
        'calories',
        'calories_from_fat',
        'total_fat',
        'saturated_fat',
        'trans_fat',
        'cholesterol',
        'sodium',
        'total_carbohydrate',
        'dietary_fiber',
        'sugars',
        'protein',
        'is_active',
    ];

    protected $casts = [
        'is_active'          => 'boolean',
        'total_fat'          => 'float',
        'saturated_fat'      => 'float',
        'trans_fat'          => 'float',
        'total_carbohydrate' => 'float',
        'dietary_fiber'      => 'float',
        'sugars'             => 'float',
        'protein'            => 'float',
    ];

    // Auto-generate slug dari name
    protected static function booted(): void
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
