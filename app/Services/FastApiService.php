<?php

namespace App\Services;

use GuzzleHttp\Client;

class FastApiService
{
    protected $client;
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = env('FASTAPI_URL', 'https://api-yovy.onrender.com'); 
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'verify' => false
        ]);
    }

    public function get($endpoint, $params = [])
    {
        try {
            $response = $this->client->get($endpoint, ['query' => $params]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['error' => 'No se pudo conectar con el servidor. Verifica tu conexión.'];
        }
    }

    public function post($endpoint, $data = [])
    {
        try {
            $response = $this->client->post($endpoint, ['json' => $data]);
            return json_decode($response->getBody(), true);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return ['error' => 'No se pudo conectar con el servidor. Verifica tu conexión.'];
        }
    }
}
