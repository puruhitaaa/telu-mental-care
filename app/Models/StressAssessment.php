<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StressAssessment extends Model
{
    protected $table = 'stress_assessments'; 

    protected $fillable = [
        'student_id',
        'q1','q2','q3','q4','q5',
        'stress_score',
        'stress_level'
    ];

    public function student()
{
    return $this->belongsTo(User::class, 'student_id');
}
}
