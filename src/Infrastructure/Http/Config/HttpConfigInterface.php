<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Config;

/**
 * Represents configuration required to perform an HTTP request.
 *
 * Implementations should be immutable and provide request details such as:
 * - Host (base URL)
 * - Endpoint path
 * - HTTP headers
 * - Query parameters
 * - Request timeout
 */
interface HttpConfigInterface
{
    /**
     * Returns API host.
     *
     * Example: "https://timeapi.io"
     *
     * @return string Base URL of the API
     */
    public function getHost(): string;

    /**
     * Returns endpoint path.
     *
     * Example: "/api/Time/current/ip"
     *
     * @return string Endpoint path relative to host
     */
    public function getPath(): string;

    /**
     * Returns HTTP headers to be sent in the request.
     *
     * Example: ['Accept' => 'application/json']
     *
     * @return array<string,string> Key-value array of headers
     */
    public function getHeaders(): array;

    /**
     * Returns query parameters for the request.
     *
     * Example: ['format' => 'json', 'ipAddress' => '1.2.3.4']
     *
     * @return array<string,string> Key-value array of query parameters
     */
    public function getParameters(): array;

    /**
     * Returns request timeout in seconds.
     *
     * Example: 5.0
     *
     * @return float Timeout in seconds
     */
    public function getTimeout(): float;
}