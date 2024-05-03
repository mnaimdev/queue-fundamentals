<?php

namespace App\Jobs;

use App\Mail\DemoMail;
use App\Mail\EmailSendingFailMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;

class SendingMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;

    public function __construct($user, $name)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::send(new DemoMail($this->user));
    }

    public function failed(\Throwable $exception)
    {
        // info('Exception: ' . $exception . 'message: ' . $exception->getMessage());

        $error = $exception->getMessage();

        // Mail::send(new EmailSendingFailMail($this->user, $error));
        // info($error);

        dd('exception found');

        Bugsnag::notifyException(new RuntimeException("Test error"));
    }
}
