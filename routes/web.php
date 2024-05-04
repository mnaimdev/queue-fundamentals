<?php

use App\Http\Controllers\SendingEmailController;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// email with queue
Route::controller(SendingEmailController::class)->group(function () {
    Route::get('sending-email', 'sendingEmail');
    Route::get('generate-invoice', 'generateInvoice');
    Route::get('message-sent', 'messageSent');
    Route::get('multiple-job', 'multipleJob');
    Route::get('job-progress', 'progressJob');
    Route::get('job-tracking/{batchId}', 'jobTracking')->name('tracking.job');
});
