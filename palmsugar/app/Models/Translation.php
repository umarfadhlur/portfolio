<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['locale', 'group', 'key', 'value'];

    /**
     * Ambil terjemahan dari cache DB.
     * Return null jika belum ada (perlu di-generate).
     */
    public static function get(string $locale, string $group, string $key): ?string
    {
        return static::where('locale', $locale)
            ->where('group', $group)
            ->where('key', $key)
            ->value('value');
    }

    /**
     * Simpan terjemahan ke cache DB.
     */
    public static function store(string $locale, string $group, string $key, string $value): void
    {
        static::updateOrCreate(
            ['locale' => $locale, 'group' => $group, 'key' => $key],
            ['value' => $value]
        );
    }
}
