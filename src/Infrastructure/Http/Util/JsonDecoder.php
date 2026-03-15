<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Http\Util;

/**
 * Responsible for decoding JSON responses.
 *
 * Provides a static method to decode JSON strings into associative arrays
 * and throws RuntimeException if JSON is invalid.
 */
final class JsonDecoder
{
    /**
     * Decode JSON string into associative array.
     *
     * @param string $json JSON string to decode
     *
     * @return array<string,mixed> Decoded data as associative array
     *
     * @throws \RuntimeException If the JSON string is invalid
     */
    #[\Pure]
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