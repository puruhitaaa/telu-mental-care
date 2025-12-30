<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StressAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\HighRiskStudentDetected;

class StressAssessmentController extends Controller
{
    public function index()
    {
        return view('student.stress.index');
    }

    public function store(Request $request)
{
    $request->validate([
        'q1' => 'required|integer|min:1|max:5',
        'q2' => 'required|integer|min:1|max:5',
        'q3' => 'required|integer|min:1|max:5',
        'q4' => 'required|integer|min:1|max:5',
        'q5' => 'required|integer|min:1|max:5',
    ]);

    $score = $request->q1 + $request->q2 + $request->q3 + $request->q4 + $request->q5;

    $level = match (true) {
        $score <= 8  => 'Low',
        $score <= 15 => 'Medium',
        default      => 'High',
    };

    $assessment = StressAssessment::create([
        'student_id'   => Auth::id(),
        'q1' => $request->q1,
        'q2' => $request->q2,
        'q3' => $request->q3,
        'q4' => $request->q4,
        'q5' => $request->q5,
        'stress_score' => $score,
        'stress_level' => $level,
    ]);

    // ===== HIGH RISK DETECTION =====
if ($score >= 18) {

    // ambil semua counselor
    $counselors = User::where('role', 'counselor')->get();

    foreach ($counselors as $counselor) {
        $counselor->notify(
            new HighRiskStudentDetected(
                Auth::user(),
                'High stress score (' . $score . ')'
            )
        );
    }
}

    return redirect()->route('student.stress.result', $assessment->id);
}

public function result($id)
{
    $assessment = StressAssessment::where('id', $id)
        ->where('student_id', Auth::id())
        ->firstOrFail();

    return view('student.stress.result', compact('assessment'));
}
}
