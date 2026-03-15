<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Util;

/**
 * Class JsonDecoder
 *
 * Responsible for decoding JSON responses.
 */
final class JsonDecoder
{
    /**
     * Decode JSON string into associative array.
     *
     * @return array<string,mixed>
     *
     * @throws \RuntimeException
     */
    public static function decode(string $json): array
    {
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException(
                'JSON decode error: ' . json_last_error_msg()
            );
        }

        return $data;
    }
}