<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ConsultationRequest;

class NewCounselingRequest extends Notification
{
    use Queueable;

    public function __construct(public ConsultationRequest $request) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Counseling Request',
            'message' => $this->request->student->name . ' submitted a counseling request.',
            'request_id' => $this->request->id,
            'url' => route('counselor.schedule.index'),
        ];
    }
}