<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsvpResponse extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'status',
        'number_of_guests',
        'message',
    ];
}