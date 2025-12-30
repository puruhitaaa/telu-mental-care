<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\CounselingReport;

class CounselingReportSent extends Notification
{
    public function __construct(
        public $counselor,
        public CounselingReport $report
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'title' => 'Counseling Report Ready',
        'message' => 'Your counseling report is available. Click to download.',
        'url' => route('student.reports.download', $this->report->id),
    ];
}
}