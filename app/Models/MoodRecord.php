<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoodRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mood_level',
        'stress_level',
        'note',
    ];
}
