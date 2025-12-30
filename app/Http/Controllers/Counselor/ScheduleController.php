<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationRequest;
use App\Notifications\CounselingCompleted;
use App\Models\StudentFeedback;

class ScheduleController extends Controller
{
    public function index()
{
    // Ambil request yang BELUM di-assign + milik counselor ini
    $schedules = ConsultationRequest::with('student')
        ->where(function ($q) {
            $q->whereNull('counselor_id')
              ->orWhere('counselor_id', auth()->id());
        })
        ->orderBy('preferred_date')
        ->orderBy('preferred_time')
        ->get();

    return view('counselor.schedule.index', compact('schedules'));
}

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,confirmed,completed',
    ]);

    $schedule = ConsultationRequest::with('student')->findOrFail($id);

    // ===============================
    // CEGAH UPDATE STATUS SAMA
    // ===============================
    if ($schedule->status === $request->status) {
        return back()->with('success', 'Status already up to date.');
    }

    // ===============================
    // UPDATE STATUS + ASSIGN COUNSELOR
    // ===============================
    $schedule->update([
        'status'        => $request->status,
        'counselor_id'  => auth()->id(), // pastikan counselor tersimpan
    ]);

    // ===============================
    // KIRIM NOTIF JIKA COMPLETED
    // (HANYA SEKALI)
    // ===============================
    if ($request->status === 'completed') {
        $schedule->student->notify(
            new CounselingCompleted($schedule)
        );
    }

    return back()->with('success', 'Schedule status updated successfully.');
}

public function show($id)
{
    $schedule = ConsultationRequest::with([
        'student',
        'counselor',
        'feedback' 
    ])->findOrFail($id);

    return view('counselor.schedule.show', compact('schedule'));
}
}
