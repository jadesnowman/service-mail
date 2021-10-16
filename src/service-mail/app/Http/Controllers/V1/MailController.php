<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\Logics\V1\SendingEmail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __construct(SendingEmail $logic)
    {
        $this->logic = $logic;
    }

    public function sendEmail(Request $request)
    {
        return $this->logic->send($request);
    }
}
