<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\MoodRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodRecordController extends Controller
{
    public function index()
    {
        $moods = MoodRecord::where('student_id', Auth::id())
            ->latest()
            ->get();

        return view('student.mood.index', compact('moods'));
    }

    public function store(Request $request)
{
    $request->validate([
    'mood_level'   => 'required|integer|min:1|max:5',
    'stress_level' => 'required|integer|min:1|max:5',
    'note'         => 'nullable|string|max:500',
]);

MoodRecord::create([
    'student_id'   => auth()->id(),
    'mood_level'   => $request->mood_level,
    'stress_level' => $request->stress_level,
    'note'         => $request->note,
]);

return redirect()
    ->route('student.dashboard')
    ->with('success', 'Mood saved successfully');
}
}