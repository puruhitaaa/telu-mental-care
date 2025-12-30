<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',                 
        'profile_photo_path',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* =====================================================
     | RELATIONSHIPS
     |=====================================================*/

    /**
     * Student → Stress Assessments
     */
    public function stressAssessments()
    {
        return $this->hasMany(
            \App\Models\StressAssessment::class,
            'student_id'
        );
    }

    /**
     * Student → Mood Records
     */
    public function moodRecords()
    {
        return $this->hasMany(
            \App\Models\MoodRecord::class,
            'student_id'
        );
    }

    /**
     * Student → Consultation Requests
     */
    public function consultationRequests()
    {
        return $this->hasMany(
            \App\Models\ConsultationRequest::class,
            'student_id'
        );
    }

    /**
     * Student → Counselor Notes (AKAN DIPAKAI)
     */
    public function counselorNotes()
    {
        return $this->hasMany(
            \App\Models\CounselorNote::class,
            'student_id'
        );
    }

    public function receivedReports()
{
    return $this->hasMany(
        \App\Models\CounselingReport::class,
        'student_id'
    );
}

public function receivedFeedbacks()
{
    return $this->hasMany(
        StudentFeedback::class,
        'counselor_id'
    );
}
}
