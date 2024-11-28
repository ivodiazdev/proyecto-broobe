<?php

namespace App\Services;

use GuzzleHttp\Client;

class PageSpeedService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false, //se agrego para evitar el error de certificado SSL, no deberia estar en produccion
        ]);
    }

    public function getMetrics(string $url, array $categories, string $strategy): array
    {
        try {
            $endpoint = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed";
            $categoriesQuery = implode('&category=', $categories);
            $curl = $this->client->get("{$endpoint}?url={$url}&category={$categoriesQuery}&strategy={$strategy}");
            $response = ['data' => json_decode($curl->getBody(), true), 'ok' => true];
        } catch (\Throwable $th) {
            $response = [
                'error' => 'No se pudo obtener la información de la API de PageSpeed',
                'details' => $th->getMessage(),
                'ok' => false
            ];
        }
        
        return $response;
    }
}
