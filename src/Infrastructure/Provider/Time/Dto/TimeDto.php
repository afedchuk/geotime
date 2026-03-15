<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Time;

/**
 * Class TimeDto
 *
 * Data Transfer Object representing the time API response.
 */
final class TimeDto
{
    public function __construct(
        private readonly string $dateTime,
        private readonly string $timeZone
    ) {}

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function getTimeZone(): string
    {
        return $this->timeZone;
    }

    /**
     * Create DTO from raw API array response.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        if (!isset($data['dateTime']) || !is_string($data['dateTime'])) {
            throw new \RuntimeException('Invalid time API response: missing dateTime.');
        }

        if (!isset($data['timeZone']) || !is_string($data['timeZone'])) {
            throw new \RuntimeException('Invalid time API response: missing timeZone.');
        }

        return new self($data['dateTime'], $data['timeZone']);
    }

    /**
     * Convert DTO back to array.
     *
     * @return array<string,string>
     */
    public function toArray(): array
    {
        return [
            'dateTime' => $this->dateTime,
            'timeZone' => $this->timeZone,
        ];
    }
}