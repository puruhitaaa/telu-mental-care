<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConsultationRequest;

/* =======================
   ✅ TAMBAHAN (WAJIB ADA)
======================= */
use App\Models\MoodRecord;
use Carbon\Carbon;
/* ======================= */

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $consultationRequest = ConsultationRequest::where('student_id', $userId)
    ->latest()
    ->first();

        $moodData = MoodRecord::where('student_id', $userId)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(6))
            ->orderBy('created_at')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($date)->format('D');

            if (isset($moodData[$date])) {
                $data[] = round($moodData[$date]->avg('mood_level'), 1);
            } else {
                $data[] = null;
            }
        }
        /* ======================= */

        /* =======================
           ✅ TAMBAHAN
           (NOTIF SUKSES)
        ======================= */
        $moodSavedToday = MoodRecord::where('student_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->exists();
        /* ======================= */

        return view('student.dashboard', compact(
    'labels',
    'data',
    'moodSavedToday',
    'consultationRequest'
));
    }
}
