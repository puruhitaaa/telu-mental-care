<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationRequest;
use App\Models\StudentFeedback;
use App\Models\User;
use App\Notifications\StudentFeedbackSent;

class StudentFeedbackController extends Controller
{
    public function create(ConsultationRequest $consultation)
    {
        abort_if(auth()->id() !== $consultation->student_id, 403);
        abort_if($consultation->status !== 'completed', 403);

        return view('student.feedback.create', compact('consultation'));
    }

    public function store(Request $request, ConsultationRequest $consultation)
    {
        abort_if(auth()->id() !== $consultation->student_id, 403);
        abort_if($consultation->status !== 'completed', 403);

        $request->validate([
            'feedback' => 'required|string|min:3',
        ]);

        // 🔥 SIMPAN FEEDBACK (WAJIB DISIMPAN KE VARIABLE)
        $feedback = StudentFeedback::create([
    'consultation_id' => $consultation->id,
    'student_id'      => auth()->id(),
    'counselor_id'    => $consultation->counselor_id,
    'feedback'        => $request->feedback,
]);

$consultation->counselor
    ->notify(new StudentFeedbackSent($feedback));

        return redirect()
            ->route('student.feedback.create', $consultation->id)
            ->with('success', 'Feedback submitted successfully.');
    }
}
