<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/send-mail', function () {
    return 'heloo';
});
Route::get('/sendmail', [MailController::class, 'sendEmail']);

// Route::resource('sendmail', MailController::class);


