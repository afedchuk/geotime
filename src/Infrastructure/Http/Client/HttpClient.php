<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;

/**
 * Class HttpClient
 *
 * Responsible for executing HTTP requests using configuration
 * provided by HttpConfigInterface.
 *
 * This client acts as a thin wrapper around Guzzle HTTP client
 * and isolates HTTP communication from business logic.
 */
final class HttpClient
{
    private Client $client;

    /**
     * HttpClient constructor.
     *
     * @param HttpConfigInterface $config Request configuration
     */
    public function __construct(
        private readonly HttpConfigInterface $config
    ) {
        $this->client = new Client([
            'timeout' => $config->getTimeout()
        ]);
    }

    /**
     * Returns HTTP configuration used by the client.
     */
    public function getConfig(): HttpConfigInterface
    {
        return $this->config;
    }

    /**
     * Executes HTTP GET request.
     *
     * @throws \RuntimeException when request fails
     */
    public function fetchData(): ResponseInterface
    {
        $options = [
            'headers' => $this->config->getHeaders(),
        ];

        if ($parameters = $this->config->getParameters()) {
            $options['query'] = $parameters;
        }

    
        try {
            return $this->client->request(
                'GET',
                $this->config->getHost() . $this->config->getPath(),
                $options
            );
        } catch (\Throwable $e) {
            throw new \RuntimeException(
                'Error fetching data: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }
}