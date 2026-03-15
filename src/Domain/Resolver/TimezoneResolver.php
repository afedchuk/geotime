<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Domain\Resolver;

use Afedchuk\GeoTime\Infrastructure\Provider\Time\TimeFetcherInterface;

/**
 * Class TimezoneResolver
 *
 * Resolves timezone based on server IP.
 */
final class TimezoneResolver
{
    public function __construct(private readonly TimeFetcherInterface $fetcher) {}

    /**
     * Resolve timezone by IP.
     */
    public function resolve(string $ip): string
    {
        return $this->fetcher->fetchTimezone($ip); 
    }
}
