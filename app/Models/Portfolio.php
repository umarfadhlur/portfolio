<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'portfolio_name',
        'description',
        'roles',
        'contributions',
        'tech_stack',
    ];

    protected $casts = [
        'roles' => 'array',
        'contributions' => 'array',
        'tech_stack' => 'array',
    ];

    public function photos()
    {
        return $this->hasMany(PortfolioPhoto::class)->orderBy('sort_order');
    }
}

