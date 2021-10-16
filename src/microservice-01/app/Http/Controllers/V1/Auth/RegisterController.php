<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Connections\RegresConnection;
use App\Traits\JsonResponse;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use JsonResponse;

    public function __construct(RegresConnection $connection)
    {
        $this->connection = $connection;
    }

    public function register(Request $request)
    {
        try {
            $data = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];

            $response = json_decode($this->connection->post('api/register', $data));
            return $this->succcess('Congratulations your account registration success!', $response);
        } catch (\Exception $e) {
            if ($e instanceof GuzzleException) {
                $exception = json_decode((string) $e->getResponse()->getBody());
                return $this->fail($exception->error, null, $e->getCode());
            } else {
                return $this->fail($e->getMessage(), null, 400);
            }
        }
    }
}
