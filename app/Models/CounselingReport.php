<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CounselingReport extends Model
{
    use HasFactory;

    protected $fillable = [
    'student_id',
    'counselor_id',
    'feedback',
    'file_path',
    'sent_at',
];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /* ================= RELATIONS ================= */

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }
}
