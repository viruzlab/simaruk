<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'code',
        'floor',
        'capacity',
        'facilities',
        'photos',
        'status',
    ];

    protected $casts = [
        'photos' => 'array',
    ];
}
