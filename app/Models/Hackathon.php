<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hackathon extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'registration_date_begin' => 'date',
        'registration_date_end' => 'date',
        'start_date_begin' => 'date',
        'start_date_end' => 'date',
    ];
}
