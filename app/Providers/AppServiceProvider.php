<?php

namespace App\Providers;

use App\Events\SendingMailEvent;
use App\Listeners\SendingMailEventListener;
use App\Mail\EmailSendingFailMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            SendingMailEvent::class,
            SendingMailEventListener::class,
        );

        // Queue::failing(function (\Throwable $exception) {
        //     $error = $exception->getMessage();
        //     $user = 'mnaimdev@gmail.com';

        //     Mail::send(new EmailSendingFailMail($user, $error));
        //     info($error);
        // });
    }
}
