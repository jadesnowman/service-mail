<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Mail\MailService;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    use JsonResponse;

    public function sendEmail(Request $request)
    {
        try {
            $this->validate($request, [
                'from'          => 'required|email',
                'to'            => 'required|email',
                'subject'       => 'required',
                'content'       => 'required',
            ]);

            $data = new \StdClass;
            $data->from = $request->from;
            $data->to = $request->to;
            $data->subject = $request->subject;
            $data->content = $request->content;

            Mail::to($request->to)->send(new MailService($data));
            return $this->succcess('Sending email!', $data);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
