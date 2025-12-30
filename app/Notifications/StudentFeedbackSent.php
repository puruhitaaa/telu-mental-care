<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\StudentFeedback;

class StudentFeedbackSent extends Notification
{
    protected $feedback;

    public function __construct(StudentFeedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
{
    return [
        'type' => 'student_feedback',
        'title' => 'New Student Feedback',
        'message' => 'A student has submitted feedback for a counseling session.',
        'consultation_id' => $this->feedback->consultation_id,

        // 🔥 INI YANG SEBELUMNYA TIDAK ADA
        'url' => route(
            'counselor.schedule.show',
            $this->feedback->consultation_id
        ),
    ];
}
}
