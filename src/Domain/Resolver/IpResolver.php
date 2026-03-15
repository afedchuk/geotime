<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Domain\Resolver;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\IpFetcherInterface;

/**
 * Resolves external IP address of the server.
 */
final class IpResolver
{
    /**
     * @param IpFetcherInterface $fetcher HTTP fetcher for external IP
     */
    public function __construct(private readonly IpFetcherInterface $fetcher) {}

    /**
     * Resolve server external IP.
     *
     * @return string External IP address
     */
    public function resolve(): string
    {
        return $this->fetcher->fetchIp()->ip;
    }
}