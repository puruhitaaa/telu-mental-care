<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'counselor_id',
        'topic',
        'preferred_date',
        'preferred_time',
        'urgency',
        'communication',
        'notes',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function feedback()
    {
        return $this->hasOne(StudentFeedback::class, 'consultation_id');
    }
}
