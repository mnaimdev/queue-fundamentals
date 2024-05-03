<?php

namespace App\Listeners;

use App\Events\SendingMailEvent;
use App\Mail\DemoMail;
use App\Notifications\SendingMailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendingMailEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendingMailEvent $event): void
    {
        // Mail::queue(new DemoMail($event->user));
        Notification::send($event->user, new SendingMailNotification());
    }
}
