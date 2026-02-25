<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'headline',
        'subheadline',
        'image',
        'cta_text',
        'cta_url',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    // ================= BOOT (AUTO LOGIC) =================

    protected static function boot()
    {
        parent::boot();

        // Auto Convert Image to WebP (Saat Create atau Update)
        static::saving(function ($slider) {
            if ($slider->isDirty('image') && $slider->image) {
                try {
                    $originalPath = $slider->image;

                    // Cek jika belum webp, baru convert
                    if (!Str::endsWith(strtolower($originalPath), '.webp')) {

                        // Path file fisik di storage
                        $fullPath = Storage::disk('public')->path($originalPath);

                        if (file_exists($fullPath)) {
                            // Load Image
                            $image = Image::read($fullPath);

                            // Convert to WebP (Quality 80 - Cukup bagus buat slider besar)
                            $encoded = $image->toWebp(80);

                            // Buat nama file baru (.webp)
                            $newPath = preg_replace('/\.[^.]+$/', '.webp', $originalPath);

                            // Simpan file baru
                            Storage::disk('public')->put($newPath, $encoded);

                            // Hapus file lama (JPG/PNG)
                            Storage::disk('public')->delete($originalPath);

                            // Update data di database
                            $slider->image = $newPath;
                        }
                    }
                } catch (\Exception $e) {
                    // Silent fail: Kalau error convert, biarkan pakai gambar asli
                }
            }
        });
    }
}
