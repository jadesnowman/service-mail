<?php

namespace App\Http\Controllers;

use App\Mail\MailService;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $sendEmail = Mail::to('ilhamsaputrajati@yopmail.com')->send(new MailService());
        return $sendEmail;
    }
}
