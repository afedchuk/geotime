<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Time;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;
use GuzzleHttp\Client;

/**
 * Fetches timezone information for a given IP from an external API.
 *
 * Encapsulates HTTP request execution and response handling.
 */
final class TimeFetcher implements TimeFetcherInterface
{
    /**
     * Constructor.
     *
     * @param HttpConfigInterface $config HTTP configuration for Time API
     */
    public function __construct(private readonly HttpConfigInterface $config)
    {
    }

    /**
     * Fetch timezone name for a given IP.
     *
     * @param string $ip IP address to resolve timezone for
     * @return string Timezone name, e.g., "Europe/Kiev"
     *
     * @throws \RuntimeException If API response is invalid
     */
    #[\Pure]
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

        if (!is_array($data)) {
            throw new \RuntimeException('Invalid API response: expected JSON object.');
        }

        return $data['timeZone'] ?? 'UTC';
    }
}