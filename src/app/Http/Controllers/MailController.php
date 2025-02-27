<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\BasicMailable;

class MailController extends Controller
{
    public function sendEmail()
    {
        var_dump('here');
        // return BasicMailable::new()
        //     ->subject('Basic Mailable')
        //     ->view('emails.basic')
        //     ->to('test@abv.bg')
        //     ->send();
        //     var_dump($this->sendEmail());
        $recipient = 'test@abv.bg';
        $details = [
            'name' => 'Customer Name',
            'action_url' => 'https://example.com/login',
        ];
        Mail::to($recipient)->send(new BasicMailable($details));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
