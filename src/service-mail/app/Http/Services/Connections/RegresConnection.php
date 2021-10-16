<?php

namespace App\Http\Services\Connections;

use App\Traits\CreateConnection;

class RegresConnection
{
    use CreateConnection;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = env('REGRES_SERVICE_URL', null);
    }

    public function post($url, $data, $headers = [])
    {
        return $this->connect('POST', $url, $data, $headers);
    }
}
