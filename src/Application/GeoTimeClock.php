<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Application;

use Afedchuk\GeoTime\Domain\Resolver\IpResolver;
use Afedchuk\GeoTime\Domain\Resolver\TimezoneResolver;
use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;

final class GeoTimeClock implements ClockInterface
{
    public function __construct(
        private readonly IpResolver $ipResolver,
        private readonly TimezoneResolver $timezoneResolver
    ) {}

    /**
     * Returns current time for server timezone.
     */
    public function now(): DateTimeImmutable
    {
        $ip = $this->ipResolver->resolve();
        $timezone = $this->timezoneResolver->resolve($ip); 

        return new DateTimeImmutable(
            'now',
            new DateTimeZone($timezone)
        );
    }
}