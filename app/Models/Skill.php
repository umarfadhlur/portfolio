<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Skill extends Model
{

    protected $fillable = ['name', 'start_year', 'level'];

    // accessor: hitung lama pengalaman
    public function getYearsOfExpAttribute(): string
    {
        $years = now()->year - $this->start_year;
        return $years . ' years';
    }
}
