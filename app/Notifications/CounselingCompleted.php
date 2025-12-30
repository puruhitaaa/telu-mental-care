<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CounselingCompleted extends Notification
{
    use Queueable;

    public function __construct(
        public $consultation
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => '📝 Counseling Completed',
            'message' => 'Your counseling session has been completed. Please provide your feedback.',
            'url'     => route('student.feedback.create', $this->consultation->id),
        ];
    }
}
