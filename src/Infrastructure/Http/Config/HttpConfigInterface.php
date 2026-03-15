<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Config;

/**
 * Interface HttpConfigInterface
 *
 * Represents configuration required to perform an HTTP request.
 * Implementations should be immutable and provide request details
 * such as host, path, headers, query parameters and timeout.
 */
interface HttpConfigInterface
{
    /**
     * Returns API host.
     *
     * Example: https://timeapi.io
     */
    public function getHost(): string;

    /**
     * Returns endpoint path.
     *
     * Example: /api/Time/current/ip
     */
    public function getPath(): string;

    /**
     * Returns HTTP headers used in the request.
     *
     * @return array<string,string>
     */
    public function getHeaders(): array;

    /**
     * Returns query parameters for the request.
     *
     * @return array<string,string>
     */
    public function getParameters(): array;

    /**
     * Returns request timeout in seconds.
     */
    public function getTimeout(): float;
}