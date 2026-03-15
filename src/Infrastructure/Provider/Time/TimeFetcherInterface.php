<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Time;

interface TimeFetcherInterface
{
    /**
     * Fetches current time for a given IP as DateTimeImmutable.
     *
     * @param string $ip
     * @return DateTimeImmutable
     */
    public function fetchTimezone(string $ip): string;
}