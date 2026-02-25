<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'post_id',      // ID artikel yang dikomentari
        'name',         // Nama pengomentar (Guest)
        'email',        // Email pengomentar
        'content',      // Isi komentar
        'is_approved',  // Status moderasi (true = tampil di web)
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * Relasi ke Post (Setiap komentar milik satu post)
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope query untuk mengambil komentar yang sudah disetujui saja.
     * Cara pakai di Controller: $post->comments()->approved()->get();
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }
}
