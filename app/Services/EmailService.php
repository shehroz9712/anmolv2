<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendEmail($user, $subject, $mailable)
    {
        Mail::to($user)->send($mailable);
    }
}
