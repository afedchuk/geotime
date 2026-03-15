<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;

/**
 * Class IpMapper
 *
 * Maps raw API response data into a typed IpDto object.
 *
 * Supports standard IP APIs like ipify.org and premium APIs like ipgeolocation.io.
 *
 * @package Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper
 */
final class IpMapper implements IpMapperInterface
{
    /**
     * Maps API response array into IpDto.
     *
     * @param array<string, mixed> $data Raw API response
     * @return IpDto
     * @throws \RuntimeException If the IP field is missing or invalid
     */
    public function map(array $data): IpDto
    {
        if (isset($data['ip']) && is_string($data['ip'])) {
            return new IpDto($data['ip']);
        }


        if (isset($data['ipAddress']) && is_string($data['ipAddress'])) {
            return new IpDto($data['ipAddress']);
        }

        throw new \RuntimeException('Invalid API response: missing IP address.');
    }
}