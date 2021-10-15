<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Connections\RegresConnection;
use App\Traits\JsonResponse;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Validator;

class LoginController extends Controller
{
    use JsonResponse;

    public function __construct(RegresConnection $connection)
    {
        $this->connection = $connection;
    }

    public function login(Request $request)
    {
        try {
            Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ])->validate();

            $data = [
                'email'     => $request->email,
                'password'  => $request->password,
            ];

            $response = json_decode($this->connection->post('api/login', $data));
            return $this->succcess('Login Success!', $response);
        } catch (\Exception $e) {
            return $this->handleErrorMessage($e);
        }
    }
}
