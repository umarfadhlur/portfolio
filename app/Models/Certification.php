<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{

    protected $fillable = [
        'name',
        'issuer',
        'valid_from',
        'valid_thru',
        'certificate_pdf',
    ];

    // accessor: kalau valid_thru null → tampilkan "Lifetime"
    public function getValidityAttribute(): string
    {
        return $this->valid_thru
            ? "{$this->valid_from} - {$this->valid_thru}"
            : "{$this->valid_from} - Lifetime";
    }
}
