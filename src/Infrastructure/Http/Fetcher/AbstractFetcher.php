<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Fetcher;

use Afedchuk\GeoTime\Infrastructure\Http\Client\HttpClient;
use Afedchuk\GeoTime\Infrastructure\Http\Util\JsonDecoder;

/**
 * Class AbstractFetcher
 *
 * Base class for API fetchers.
 * Provides common functionality for executing HTTP requests
 * and decoding JSON responses.
 */
abstract class AbstractFetcher
{
    public function __construct(
        protected readonly HttpClient $client
    ) {}

    /**
     * Execute request and return decoded response.
     *
     * @return array<string,mixed>
     */
    protected function fetch(): array
    {
        $response = $this->client->fetch();

        return JsonDecoder::decode(
            $response->getBody()->getContents()
        );
    }
}