<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounselorNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'counselor_id',
        'note',
    ];

    /* =======================
     | RELATIONSHIPS
     |=======================*/

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }
}
