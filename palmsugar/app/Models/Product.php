<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'short_description',
        'description',
        'specifications',
        'brochure_file',
        'is_featured',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured'    => 'boolean',
    ];

    // ── Scopes ──────────────────────────────────────────
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // ── Accessors ────────────────────────────────────────

    /**
     * Ambil flavor profile dari specifications JSON.
     * Struktur: specifications.flavor_profile = ['Fragrance' => 8.0, ...]
     */
    public function getFlavorProfileAttribute(): array
    {
        return $this->specifications['flavor_profile'] ?? [];
    }

    /**
     * Cupping score total (key: cupping_score di dalam specifications).
     */
    public function getCuppingScoreAttribute(): ?float
    {
        return $this->specifications['cupping_score'] ?? null;
    }

    /**
     * Kategori produk (Arabica / Robusta / dst).
     */
    public function getCategoryAttribute(): ?string
    {
        return $this->specifications['category'] ?? null;
    }

    /**
     * Route model binding via slug.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
