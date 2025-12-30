<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class HighRiskStudentDetected extends Notification
{
    use Queueable;

    public function __construct(
        public $student,
        public string $reason
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => '🚨 High-Risk Student Detected',
            'message' => $this->student->name . ' requires immediate attention.',
            'reason'  => $this->reason,
            'url'     => route('counselor.highrisk.index'),
        ];
    }
}
