<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Domain\Resolver;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\IpFetcherInterface;

/**
 * Class IpResolver
 *
 * Resolves external IP address of the server.
 */
final class IpResolver
{
    public function __construct(private readonly IpFetcherInterface $fetcher) {}

    /**
     * Resolve server external IP.
     */
    public function resolve(): string
    {
        return $this->fetcher->fetchIp()->getIp();
    }
}