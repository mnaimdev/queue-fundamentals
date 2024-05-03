<?php

namespace App\Http\Controllers;

use App\Events\SendingMailEvent;
use App\Jobs\GenerateInvoiceJob;
use App\Jobs\MessageSentJob;
use App\Jobs\SendingMailJob;
use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendingEmailController extends Controller
{
    public function sendingEmail()
    {
        try {
            $user = 'mnaimdev@gmail.com';
            $name = 'Mohammad Naim';

            // Mail::queue(new DemoMail($user));

            // SendingMailEvent::dispatch($user);

            SendingMailJob::dispatch($user, $name);

            dd('sent');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function generateInvoice()
    {
        try {
            // long running jobs
            GenerateInvoiceJob::dispatch();

            dd('generated');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function messageSent()
    {
        try {
            MessageSentJob::dispatch();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
