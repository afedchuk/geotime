<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Time\Mapper;

use Afedchuk\GeoTime\Infrastructure\Provider\Time\Dto\TimeDto;

/**
 * Class TimeMapper
 *
 * Converts raw API response arrays into TimeDto instances.
 */
final class TimeMapper implements TimeMapperInterface
{
    /**
     * Map raw API response to TimeDto.
     *
     * @param array<string,mixed> $data
     */
    public function map(array $data): TimeDto
    {
        return TimeDto::fromArray($data);
    }
}