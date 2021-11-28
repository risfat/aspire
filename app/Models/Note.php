<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $casts = [

        'updated_at' => 'datetime',
    ];
    use HasFactory;
}
