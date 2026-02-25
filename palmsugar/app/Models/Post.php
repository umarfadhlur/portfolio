<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'content',
        'published_at',
        'is_published',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    // ================= RELASI =================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // ================= SCOPES =================

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // ================= BOOT (AUTO LOGIC) =================

    protected static function boot()
    {
        parent::boot();

        // 1. Auto Slug saat Create
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        // 2. Auto Convert Thumbnail to WebP (Saat Create atau Update)
        static::saving(function ($post) {
            if ($post->isDirty('thumbnail') && $post->thumbnail) {
                try {
                    $originalPath = $post->thumbnail;

                    // Cek jika belum webp, baru convert
                    if (!Str::endsWith(strtolower($originalPath), '.webp')) {

                        // Path file fisik di storage
                        $fullPath = Storage::disk('public')->path($originalPath);

                        if (file_exists($fullPath)) {
                            // Load Image
                            $image = Image::read($fullPath);

                            // Convert to WebP (Quality 80)
                            $encoded = $image->toWebp(80);

                            // Buat nama file baru (.webp)
                            $newPath = preg_replace('/\.[^.]+$/', '.webp', $originalPath);

                            // Simpan file baru
                            Storage::disk('public')->put($newPath, $encoded);

                            // Hapus file lama (JPG/PNG)
                            Storage::disk('public')->delete($originalPath);

                            // Update data di database
                            $post->thumbnail = $newPath;
                        }
                    }
                } catch (\Exception $e) {
                }
            }
        });
    }
}
