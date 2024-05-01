<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendingEmailController extends Controller
{
    public function sendingEmail()
    {
        try {
            $user = 'mnaimdev@gmail.com';

            Mail::queue(new DemoMail($user));

            dd('sent');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
