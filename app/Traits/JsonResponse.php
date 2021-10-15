<?php

namespace App\Traits;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Validation\ValidationException;

trait JsonResponse
{
    protected $version = '1.0';

    public function succcess($message, $data = "", $code = 200)
    {
        return response()->json([
            'success'   => false,
            'message'   => $message,
            'data'      => $data,
            'code'      => $code,
            'version'   => $this->version,
        ], $code);
    }

    public function fail($message, $data = "", $code = 400)
    {
        return response()->json([
            'success'   => false,
            'message'   => $message,
            "data"      => $data,
            'code'      => $code,
            'version'   => $this->version,
        ], $code);
    }

    public function handleErrorMessage($exception)
    {
        \Sentry\captureMessage($exception);

        if ($exception instanceof GuzzleException) {
            $exception = json_decode((string) $exception->getResponse()->getBody());
            return $this->fail($exception->error, null, $exception->getCode());
        }

        if ($exception instanceof ValidationException) {
            return $this->fail($exception->validator->messages()->messages(), null, 409);
        }

        return $this->fail($exception->getMessage(), null, 400);
    }
}
