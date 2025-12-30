<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CounselingReport;
use Illuminate\Support\Facades\Storage;

class StudentReportController extends Controller
{
    public function download(CounselingReport $report)
{
    abort_if(auth()->id() !== $report->student_id, 403);

    // ✅ CEK FILE DI PUBLIC DISK
    if (!Storage::disk('public')->exists($report->file_path)) {
        abort(404, 'Report file not found');
    }

    return Storage::disk('public')->download($report->file_path);
}
}