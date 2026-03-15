<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto;

/**
 * Data Transfer Object for external IP address.
 *
 * Encapsulates a single external IP value and provides access methods.
 */
final class IpDto
{
    /**
     * External IP address.
     *
     * @var string
     */
    private readonly string $ip;

    /**
     * IpDto constructor.
     *
     * @param string $ip External IP address
     */
    public function __construct(string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns the IP address.
     *
     * @return string
     */
    #[\Pure]
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Returns the IP as string when object is cast to string.
     *
     * @return string
     */
    #[\Pure]
    public function __toString(): string
    {
        return $this->ip;
    }
}