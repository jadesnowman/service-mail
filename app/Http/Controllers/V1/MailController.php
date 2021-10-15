<?php

namespace App\Http\Controllers\V1;

use App\Mail\MailService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MailController extends Controller
{
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

            return response()->json([
                "message"   => "Queued. Thank you.",
                "data"      => $data,
                "version"   => "1.0",
                "code"      => 200
            ], 200);
        } catch (\Throwable $exception) {
            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data you are looking for does not found',
                    'data' => null,
                    'code' => 404
                ], 404)->header('Content-Type', 'application/json');
            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->validator->errors()->all(),
                    'data' => null,
                    'code' => 409
                ], 409)->header('Content-Type', 'application/json');
            }

            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Are you lost in somewhere?',
                    'data' => null,
                    'code' => 404
                ], 404)->header('Content-Type', 'application/json');
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json([
                    'success' => false,
                    'message' => 'We don\'t understand what do u ask for',
                    'data' => null,
                    'code' => 500
                ], 500)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null,
                'code' => 400
            ], 400)->header('Content-Type', 'application/json');
        }
    }
}
