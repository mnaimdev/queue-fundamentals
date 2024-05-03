<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;

class GenerateSingleInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $users = User::take(500)->get();
        // $email = 'mnaimdev@gmail.com';
        $name = 'Mohammad Naim';

        // foreach ($users as $user) {
        //     SendingMailJob::dispatch($email, $name);
        // }

        $seller = new Party([
            'name' => 'Mir Faisal',
        ]);

        $invoiceNumber = 1;

        foreach ($users as $user) {

            $customer = new Party([
                'name'      => $name,
                'address'   => 'Dhaka',
                'custom_fields' => [
                    'email'     => $user->email,
                ]
            ]);

            $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

            Invoice::make()
                ->seller($seller)
                ->buyer($customer)
                ->sequence($invoiceNumber)
                ->filename('invoices/invoice_' . $invoiceNumber)
                ->addItem($item)
                ->save();

            $invoiceNumber++;
        }
    }
}
