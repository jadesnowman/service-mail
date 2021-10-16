<?php

namespace App\Http\Services\Logics\V1;

use App\Mail\MailService;
use App\Traits\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Validator;

class SendingEmail
{
    use JsonResponse;

    public function send($request)
    {
        try {
            Validator::make($request->all(), [
                'from'          => 'required|email',
                'to'            => 'required|email',
                'subject'       => 'required',
                'content'       => 'required',
            ])->validate();

            $data = new \StdClass;
            $data->from = $request->from;
            $data->to = $request->to;
            $data->subject = $request->subject;
            $data->content = $request->content;

            Mail::to($request->to)->send(new MailService($data));
            return $this->succcess('Message delivered!', $data);
        } catch (\Exception $exception) {
            return $this->handleErrorMessage($exception);
        }
    }
}
