<?php

namespace App\Http\Controllers\Counselor;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\StressAssessment;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\User;

class HighRiskController extends Controller
{
    /**
     * ===============================
     * HIGH RISK PAGE
     * ===============================
     * - urgency = high (consultation)
     * - stress_level = High (assessment)
     */
    public function index()
    {
        // 🔥 HIGH RISK FROM CONSULTATION REQUEST
        $highUrgency = ConsultationRequest::with('student')
            ->where('urgency', 'high')
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('preferred_date')
            ->orderBy('preferred_time')
            ->get();

        // 🔥 HIGH RISK FROM STRESS ASSESSMENT
        $highStress = StressAssessment::with('student')
            ->where('stress_level', 'High')
            ->latest()
            ->get();

        return view(
            'counselor.highrisk.index',
            compact('highUrgency', 'highStress')
        );
    }

    /**
     * ===============================
     * EXPORT ALL HIGH RISK (CSV)
     * ===============================
     */
    public function exportCsv(): StreamedResponse
    {
        $fileName = 'high_risk_students.csv';

        $highStress = StressAssessment::with('student')
            ->where('stress_level', 'High')
            ->get();

        return response()->streamDownload(function () use ($highStress) {

            $file = fopen('php://output', 'w');

            // HEADER CSV
            fputcsv($file, [
                'Student Name',
                'Email',
                'Stress Score',
                'Stress Level',
                'Date'
            ]);

            foreach ($highStress as $item) {
                fputcsv($file, [
                    $item->student->name,
                    $item->student->email,
                    $item->stress_score,
                    $item->stress_level,
                    $item->created_at->format('d M Y'),
                ]);
            }

            fclose($file);

        }, $fileName);
    }

    public function show(string $type, int $id)
{
    if ($type === 'consultation') {

        $data = ConsultationRequest::with('student')
            ->where('urgency', 'high')
            ->findOrFail($id);

        $student = $data->student;

        $reason = 'High urgency consultation request';

    } elseif ($type === 'stress') {

        $data = StressAssessment::with('student')
            ->where('stress_level', 'High')
            ->findOrFail($id);

        $student = $data->student;

        $reason = 'High stress level detected from assessment';

    } else {
        abort(404);
    }

    return view('counselor.highrisk.show', compact(
        'student',
        'data',
        'type',
        'reason'
    ));
}
}
