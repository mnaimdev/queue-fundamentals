<?php

namespace App\Jobs;

use App\Models\Message;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageSentJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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

        // if ($this->batch()->cancelled()) {
        //     return;
        // }

        $message = Message::create([
            'user_id'           => 2,
            'recipient_id'      => 5,
            'message'           => 'Hi',
        ]);

        MarkAsReadJob::dispatch($message);
    }
}
