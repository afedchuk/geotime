<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Fetcher;

use Afedchuk\GeoTime\Infrastructure\Http\Client\ClientInterface;
use Afedchuk\GeoTime\Infrastructure\Http\Util\JsonDecoder;

/**
 * Base class for API fetchers.
 *
 * Provides common functionality for executing HTTP requests
 * and decoding JSON responses.
 */
abstract class AbstractFetcher
{
    /**
     * HTTP client used to perform requests.
     */
    protected readonly ClientInterface $client;

    /**
     * AbstractFetcher constructor.
     *
     * @param ClientInterface $client HTTP client instance
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Execute request and return decoded JSON response as associative array.
     *
     * @return array<string,mixed> Decoded JSON response
     * @throws \RuntimeException if JSON decoding fails
     */
    #[\Pure]
    protected function fetch(): array
    {
        $response = $this->client->fetch();

        return JsonDecoder::decode(
            $response->getBody()->getContents()
        );
    }
}