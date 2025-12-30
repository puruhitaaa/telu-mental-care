<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewCounselingRequest;
use App\Notifications\HighRiskStudentDetected;

class ConsultationRequestController extends Controller
{
    public function create()
    {
        return view('student.request-consultation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic'          => 'required',
            'preferred_date' => 'required|date',
            'preferred_time' => 'required',
            'urgency'        => 'required',
            'communication'  => 'required',
        ]);

        // ===============================
        // SIMPAN CONSULTATION REQUEST
        // ===============================
        $requestData = ConsultationRequest::create([
            'student_id'     => Auth::id(),
            'topic'          => $request->topic,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'urgency'        => $request->urgency,
            'notes'          => $request->notes,
            'communication'  => $request->communication,
            'status'         => 'pending',
        ]);

        // ambil semua counselor
        $counselors = User::where('role', 'counselor')->get();

        // ===============================
        // HIGH RISK NOTIFICATION (URGENT)
        // ===============================
        if ($request->urgency === 'high') {
            foreach ($counselors as $counselor) {
                $counselor->notify(
                    new HighRiskStudentDetected(
                        Auth::user(),
                        'High urgency consultation request'
                    )
                );
            }
        }

        // ===============================
        // NOTIF REQUEST BIASA
        // ===============================
        foreach ($counselors as $counselor) {
            $counselor->notify(
                new NewCounselingRequest($requestData)
            );
        }

        return redirect()
            ->route('student.dashboard')
            ->with('success', 'Consultation request submitted successfully');
    }
}
