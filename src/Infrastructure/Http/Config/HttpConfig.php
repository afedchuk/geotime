<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Config;

/**
 * Default immutable implementation of HttpConfigInterface.
 *
 * Stores configuration required to perform an HTTP request.
 * This includes host, endpoint path, headers, query parameters, and timeout.
 */
final class HttpConfig implements HttpConfigInterface
{
    /**
     * @param string $host API host, e.g., "https://api.ipify.org"
     * @param string $path Endpoint path, e.g., "/"
     * @param array<string,string> $headers HTTP headers, e.g., ['Accept' => 'application/json']
     * @param array<string,string> $parameters Query parameters for GET request, e.g., ['format' => 'json']
     * @param float $timeout Request timeout in seconds (default 5.0)
     */
    public function __construct(
        private readonly string $host,
        private readonly string $path,
        private readonly array $headers = [],
        private readonly array $parameters = [],
        private readonly float $timeout = 5.0
    ) {}

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<string,string>
     */
    #[\Override]
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritDoc}
     *
     * @return array<string,string>
     */
    #[\Override]
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getTimeout(): float
    {
        return $this->timeout;
    }
}