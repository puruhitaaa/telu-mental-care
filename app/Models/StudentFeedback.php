<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ConsultationRequest;

class StudentFeedback extends Model
{
    protected $table = 'student_feedbacks';

    protected $fillable = [
        'consultation_id',
        'student_id',
        'counselor_id',
        'feedback',
    ];

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function consultation()
    {
        return $this->belongsTo(ConsultationRequest::class, 'consultation_id');
    }
}
