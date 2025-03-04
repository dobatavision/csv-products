<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMailable;

class MailController extends Controller
{
    public function sendEmail()
    {
        $recipient = 'recipient@email.com';
        $details = [
            'name' => 'dobata test',
            'action_url' => 'https://example.com/login',
        ];
        Mail::to($recipient)->send(new BasicMailable($details));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
