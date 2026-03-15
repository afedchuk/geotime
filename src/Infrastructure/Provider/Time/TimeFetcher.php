<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Time;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;
use GuzzleHttp\Client;

final class TimeFetcher implements TimeFetcherInterface
{
    public function __construct(private readonly HttpConfigInterface $config)
    {
    }

    /**
     * Fetch timezone name for a given IP.
     *
     * @param string $ip
     * @return string
     */
    public function fetchTimezone(string $ip): string
    {
        $client = new Client([
            'base_uri' => rtrim($this->config->getHost(), '/') . '/',
            'timeout'  => $this->config->getTimeout(),
        ]);

        $params = $this->config->getParameters();
        $params['ipAddress'] = $ip;

        $response = $client->request('GET', ltrim($this->config->getPath(), '/'), [
            'headers' => $this->config->getHeaders(),
            'query'   => $params,
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return $data['timeZone'] ?? 'UTC';
    }
}