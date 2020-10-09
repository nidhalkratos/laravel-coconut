<?php

namespace Nidhalkratos;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class HttpClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function post(string $url, string $payload)
    {
        $response = $this->client->post($url, [
            'body' => $payload,
            'headers' => [
                'Content-Type' => 'text/plain',
            ]
        ]);

        return $this->decode($response);
    }

    protected function decode(Response $response)
    {
        return json_decode($response->getBody());
    }
}
