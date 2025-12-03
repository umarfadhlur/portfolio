<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationSetting extends Model
{
    protected $fillable = [
        'bride_name',
        'groom_name',
        'wedding_date',
        'akad_time',
        'resepsi_time',
        'akad_location',
        'akad_address',
        'akad_map_link',
        'resepsi_location',
        'resepsi_address',
        'resepsi_map_link',
        'hero_image',
        'music_file',
        'theme_primary_color',
        'theme_secondary_color',
        'qris_image',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
    ];

    protected $casts = [
        'wedding_date' => 'date',
    ];
}