<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait CreateConnection
{
    public function connect($method, $requestUrl, $formParams = [], $headers = [], $content = 'json')
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $response = $client->request($method, $requestUrl, [$content => $formParams, 'headers' => $headers]);
        return $response->getBody()->getContents();
    }
}
