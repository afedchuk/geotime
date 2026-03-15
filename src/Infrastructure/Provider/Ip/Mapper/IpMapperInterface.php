<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;

/**
 * Interface IpMapperInterface
 *
 * Maps raw API response data into a typed IpDto object.
 *
 * @package Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper
 */
interface IpMapperInterface
{
    /**
     * Maps API response array into IpDto.
     *
     * @param array<string, mixed> $data Raw API response as associative array
     * @return IpDto
     * @throws \RuntimeException if required data is missing or invalid
     */
    public function map(array $data): IpDto;
}