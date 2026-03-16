<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;
use Psr\Http\Message\ResponseInterface;

/**
 * Class StaticIpFetcher
 *
 * Returns predefined IP without calling external API.
 */
final class StaticIpFetcher implements IpFetcherInterface
{
    public function __construct(
        private readonly string $ip
    ) {}

    /**
     * {@inheritDoc}
     */
    public function fetchIp(): IpDto
    {
        return new IpDto($this->ip);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchRaw(): ResponseInterface
    {
        throw new \RuntimeException(
            'StaticIpFetcher does not support raw HTTP response.'
        );
    }
}