<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StressAssessment;
use App\Models\MoodRecord;
use Illuminate\Http\Request;
use App\Models\CounselorNote;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Symfony\Component\HttpFoundation\Response;
use App\Models\CounselingReport;
use App\Notifications\CounselingReportSent;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentRecordController extends Controller
{
    public function index(Request $request)
{
    $students = User::where('role', 'student')
        ->when($request->search, function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        })
        ->with([
            'stressAssessments' => fn ($q) => $q->latest()->limit(1),
            'moodRecords' => fn ($q) => $q->latest()->limit(5),
        ])
        ->get()
        ->map(function ($student) {

            // ===== STRESS =====
            $latestStress = $student->stressAssessments->first();
            $stressScore = $latestStress? $latestStress->stress_score . '/25'
            : '—';

            // ===== MOOD TREND =====
            $latestMood = $student->moodRecords->first();

$moodStatus = '—';

if ($latestMood) {
    if ($latestMood->mood_level <= 2) {
        $moodStatus = 'Low Mood';
    } elseif ($latestMood->mood_level == 3) {
        $moodStatus = 'Neutral';
    } else {
        $moodStatus = 'Positive';
    }
}

            // ===== RISK STATUS =====
            $riskStatus = '—';

if ($latestStress) {
    if ($latestStress->stress_score >= 18) {
        $riskStatus = 'High Risk';
    } elseif ($latestStress->stress_score >= 12) {
        $riskStatus = 'Medium Risk';
    } else {
        $riskStatus = 'Low Risk';
    }
}

            return (object) [
                'id' => $student->id,
                'name' => $student->name,
                'stress_score' => $stressScore,
                'mood_trend' => $moodStatus,
                'risk_status' => $riskStatus,
            ];
        });

    return view('counselor.records.index', compact('students'));
}

    public function show(User $student)
{
    abort_if($student->role !== 'student', 404);

    $student->load([
        'stressAssessments' => fn ($q) => $q->latest(),
        'moodRecords' => fn ($q) => $q->latest(),
        'counselorNotes' => fn ($q) => $q->latest(),
    ]);

    return view('counselor.records.show', compact('student'));
}

public function storeNote(Request $request, User $student)
{
    $request->validate([
        'note' => 'required|string',
    ]);

    CounselorNote::create([
        'student_id'   => $student->id,
        'counselor_id' => auth()->id(),
        'note'         => $request->note,
    ]);

    return back()->with('success', 'Counselor note saved.');
}

public function updateNote(Request $request, User $student, CounselorNote $note)
{
    // pastikan note milik student ini
    abort_if($note->student_id !== $student->id, 403);

    // pastikan counselor yang login adalah pemilik note
    abort_if($note->counselor_id !== auth()->id(), 403);

    $request->validate([
        'note' => 'required|string',
    ]);

    $note->update([
        'note' => $request->note,
    ]);

    return back()->with('success', 'Note updated successfully.');
}

public function exportPdf(User $student)
{
    abort_if($student->role !== 'student', 404);

    $student->load([
        'stressAssessments' => fn ($q) => $q->latest(),
        'moodRecords'       => fn ($q) => $q->latest(),
        'counselorNotes'    => fn ($q) => $q->latest(),
    ]);

    // ================= FILE SETUP (WAJIB ADA) =================
    $studentName = str_replace(' ', '_', strtolower($student->name));
    $fileName    = "Counseling_Report_{$studentName}.pdf";
    $filePath    = "counseling_reports/{$fileName}";

    // ================= GENERATE PDF =================
    $pdf = Pdf::loadView('pdf.counseling-report', [
        'student'   => $student,
        'counselor' => auth()->user(),
    ]);

    // ================= SAVE FILE =================
    Storage::disk('public')->put($filePath, $pdf->output());

    // ================= SAVE DB =================
    $report = CounselingReport::create([
        'student_id'   => $student->id,
        'counselor_id' => auth()->id(),
        'feedback'     => 'Counseling report has been shared.',
        'file_path'    => $filePath,
    ]);

    // ================= SEND NOTIFICATION =================
    $student->notify(
        new CounselingReportSent(auth()->user(), $report)
    );

    // ================= DOWNLOAD =================
    return Storage::disk('public')->download($filePath, $fileName);
}
}