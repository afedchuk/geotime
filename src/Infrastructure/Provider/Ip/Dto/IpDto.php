<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto;

/**
 * Class IpDto
 *
 * Data Transfer Object for external IP address.
 *
 * @package Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto
 */
final class IpDto
{
    /**
     * @var string External IP address
     */
    private string $ip;

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
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * Returns the IP as string when object is cast to string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->ip;
    }
}