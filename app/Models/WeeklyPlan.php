<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyPlan extends Model
{   protected $casts = [
    'from_date' => 'datetime',
    'to_date' => 'datetime',
];
    use HasFactory;
}
