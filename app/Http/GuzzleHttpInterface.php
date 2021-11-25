<?php

namespace App\Http;


interface GuzzleHttpInterface
{

    /**
     * @param string $method
     * @param string|null $uri
     * @param array|null $options
     * @param array|null $parameters
     * @param bool|null $returnAssoc
     * @return object
     */
    public function handleRequest(string $method, ?string $uri = '', ?array $options = [], ?array $parameters = [], ?bool $returnAssoc = false): object;

}
