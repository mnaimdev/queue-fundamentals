<?php

namespace App\Http\Controllers;

use App\Events\SendingMailEvent;
use App\Jobs\DepressionJob;
use App\Jobs\GenerateInvoiceJob;
use App\Jobs\MessageSentJob;
use App\Jobs\SendingMailJob;
use App\Mail\DemoMail;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
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

            SendingMailJob::dispatch($user, $name)->delay(now()->addMinutes(2));

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

    public function multipleJob()
    {
        try {
            // Bus::chain([
            //     new DepressionJob(),
            //     new MessageSentJob(),
            // ])
            //     ->catch(function ($exception) {
            //         info('something went wrong' . $exception->getMessage());
            //     })
            //     ->dispatch();

            // Bus::batch([
            //     new DepressionJob(),
            //     new MessageSentJob(),
            // ])
            //     ->then(function (Batch $batch) {
            //         info('what is happening actually');
            //     })
            //     ->finally(function (Batch $batch) {
            //         info('all thing is done or cancel');
            //     })
            //     ->catch(function ($exception) {
            //         info('something went wrong' . $exception->getMessage());
            //     })
            //     ->dispatch();

            MessageSentJob::dispatch();
            DepressionJob::dispatch()->onQueue('priority');

            dd('done');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
