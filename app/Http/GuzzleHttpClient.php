<?php

namespace App\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Exception;


class GuzzleHttpClient implements GuzzleHttpInterface
{

    private Client $guzzle;

    public function __construct(?array $config = [])
    {
        $this->guzzle = new Client($config);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function handleRequest(string $method, ?string $uri = '', ?array $options = [], ?array $parameters = [], ?bool $returnAssoc = false): object
    {
        if ($method == 'GET') {
            $options['query'] = $parameters;
        } else {
            $options['json'] = (object)$parameters;
        }
        $response = $this->guzzle->request($method, $uri, $options);

        return json_decode($response->getBody(), $returnAssoc);


    }

}
