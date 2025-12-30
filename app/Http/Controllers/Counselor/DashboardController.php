<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\StressAssessment;
use App\Models\MoodRecord;
use App\Models\ConsultationRequest;
use App\Models\StudentFeedback;

class DashboardController extends Controller
{
    public function index()
    {
        $dates = collect(range(6,0))
            ->map(fn($i)=>now()->subDays($i)->toDateString());

        $stress = StressAssessment::selectRaw(
            'DATE(created_at) as date, AVG(stress_score) as avg'
        )
        ->where('created_at','>=',now()->subDays(6))
        ->groupBy('date')
        ->pluck('avg','date');

        $mood = MoodRecord::selectRaw(
            'DATE(created_at) as date, AVG(mood_level) as avg'
        )
        ->where('created_at','>=',now()->subDays(6))
        ->groupBy('date')
        ->pluck('avg','date');

        $schedules = ConsultationRequest::with('student')
            ->latest()
            ->take(5) // contoh: 5 jadwal terbaru
            ->get();

        $feedbacks = StudentFeedback::where('counselor_id', auth()->id())
    ->latest()
    ->take(5)
    ->get();

        return view('counselor.dashboard',[
    'labels'        => $dates,
    'stressValues'  => $dates->map(fn($d)=>$stress[$d] ?? 0),
    'moodValues'    => $dates->map(fn($d)=>$mood[$d] ?? 0),
    'schedules'     => $schedules, 
    'feedbacks'     => $feedbacks,
]);
    }
}
