<?php

namespace App\Jobs;

use App\Mail\MessageSeenMail;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MarkAsReadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $messageId;

    public function __construct($message)
    {
        $this->messageId = $message->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $message = Message::findOrFail($this->messageId);

        if ($message) {
            if ($message->read_at == '') {
                $message->update([
                    'read_at'       => Carbon::now(),
                ]);
            }

            $user = 'mnaimdev@gmail.com';

            Mail::to($user)->send(new MessageSeenMail($message));
        }
    }
}
