<?php

namespace App\Jobs;

use App\Mail\DemoMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $users = User::take(5)->get();
        // $email = 'mnaimdev@gmail.com';
        // $name = 'Mohammad Naim';

        // foreach ($users as $user) {
        //     SendingMailJob::dispatch($email, $name);
        // }
    }
}
