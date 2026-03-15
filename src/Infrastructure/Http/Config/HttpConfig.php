<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Config;

/**
 * Class HttpConfig
 *
 * Default immutable implementation of HttpConfigInterface.
 * Stores configuration required to perform an HTTP request.
 */
final class HttpConfig implements HttpConfigInterface
{
    /**
     * @param array<string,string> $headers
     * @param array<string,string> $parameters
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
     */
    #[\Override]
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritDoc}
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