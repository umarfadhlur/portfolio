<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{

    protected $fillable = [
        'name',
        'client',
        'location',
        'type_id',
        'start_date',
        'end_date',
        'description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
