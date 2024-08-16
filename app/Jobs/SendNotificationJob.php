<?php

// app/Jobs/SendNotificationJob.php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\User;
use App\Mail\UserNotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Events\NotificationSentEvent;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $notification;

    public function __construct(User $user, Notification $notification)
    {
        $this->user = $user;
        $this->notification = $notification;
    }

    public function handle()
    {
        // Sending email notification
        Mail::to($this->user->email)->send(new UserNotificationMail($this->notification));

        // Update notification status
        $this->notification->update(['status' => 'sent']);

        // Dispatch the notification event
        event(new NotificationSentEvent($this->notification));
    }
}

