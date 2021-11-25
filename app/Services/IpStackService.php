<?php

namespace App\Services;

use App\Config\Config;
use App\Http\GuzzleHttpInterface;
use Exception;


class IpStackService
{

    private GuzzleHttpInterface $httpClient;

    /**
     * @var array
     */
    private array $requestParameters;


    /**
     * @throws Exception
     */
    public function __construct(GuzzleHttpInterface $httpClient, ?array $requestParameters = [])
    {
        $this->httpClient = $httpClient;

        $apiKey = Config::get('IPSTACK_ACCESS_KEY');

        $this->requestParameters = array_merge(array(
            'access_key' => $apiKey,
        ), $requestParameters);
    }


    /**
     * @param string $ip
     * @return null
     */
    public function getContinentCode(string $ip)
    {
        try {
            $requestParameters = [
                'fields' => 'continent_code'
            ];

            return $this->handleRequest($ip, $requestParameters)->continent_code;

        } catch (Exception $e) {

             return null;
        }
    }


    /**
     * @throws Exception
     */
    private function handleRequest(string $ip, ?array $requestParameters = []): object
    {
        return $this->httpClient->handleRequest('GET', 'http://api.ipstack.com/' . $ip, null, array_merge($this->requestParameters, $requestParameters));
    }
}