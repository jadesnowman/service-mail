<?php

class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testShouldloginSuccess()
    {
        $data = [
            "email" => "eve.holt@reqres.in",
            "password" => "asas"
        ];

        $this->post('/api/v1/auth/login', $data);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'token'
            ],
            'code',
            'version',
        ]);
    }

    public function testShouldLoginFailedErrorValidation()
    {
        $data = [
            "email" => "eve.holt@reqres.in",
            "password" => ""
        ];

        $this->post('/api/v1/auth/login', $data);

        $this->seeStatusCode(409);

        $this->seeJsonStructure([
            'success',
            'message' => [
                "password",
            ],
            'data',
            'code',
            'version',
        ]);
    }

    public function testShouldRegisterFailed()
    {
        $data = [
            "email" => "eve.holt@reqres.in",
            "password" => ""
        ];

        $this->post('/api/v1/auth/register', $data);

        $this->seeStatusCode(400);

        $this->seeJsonStructure([
            'success',
            'message',
            'data',
            'code',
            'version',
        ]);
    }
}
