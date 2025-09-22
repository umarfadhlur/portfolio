<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name'];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
