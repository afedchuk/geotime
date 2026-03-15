<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Domain\Resolver;

use Afedchuk\GeoTime\Infrastructure\Provider\Time\TimeFetcherInterface;

/**
 * Resolves timezone based on server IP.
 */
final class TimezoneResolver
{
    /**
     * @param TimeFetcherInterface $fetcher HTTP fetcher for timezone data
     */
    public function __construct(private readonly TimeFetcherInterface $fetcher) {}

    /**
     * Resolve timezone by IP.
     *
     * @param string $ip External IP address
     * @return string Timezone identifier (e.g., "Europe/Kiev")
     */
    public function resolve(string $ip): string
    {
        return $this->fetcher->fetchTimezone($ip);
    }
}