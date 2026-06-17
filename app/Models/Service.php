<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'starting',
        'description',
        'note',
        'slides',
        'highlights',
        'col1',
        'col2',
    ];

    protected $casts = [
        'slides' => 'array',
        'highlights' => 'array',
        'col1' => 'array',
        'col2' => 'array',
    ];
}
