<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Factory;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfig;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;

/**
 * Provides default HTTP configurations for IP and Time APIs.
 *
 * Use these methods to get ready-to-use configurations for
 * the GeoTimeBuilder or directly for HTTP clients.
 */
final class ConfigFactory
{
    /**
     * Returns default HTTP configuration for IP fetching service.
     *
     * Example uses ipify API:
     * - Host: https://api.ipify.org
     * - Path: /
     * - Headers: Accept: application/json
     * - Query parameters: format=json
     *
     * @return HttpConfigInterface Config for IP fetcher
     */
    public static function defaultIpConfig(): HttpConfigInterface
    {
        return new HttpConfig(
            'https://api.ipify.org',
            '/',
            ['Accept' => 'application/json'],
            ['format' => 'json']
        );
    }

    /**
     * Returns default HTTP configuration for Time fetching service.
     *
     * Example uses timeapi.io API:
     * - Host: https://timeapi.io
     * - Path: /api/Time/current/ip
     * - Headers: Accept: application/json
     * - Query parameters: none by default (IP will be added dynamically)
     *
     * @return HttpConfigInterface Config for Time fetcher
     */
    public static function defaultTimeConfig(): HttpConfigInterface
    {
        return new HttpConfig(
            'https://timeapi.io',
            '/api/Time/current/ip',
            ['Accept' => 'application/json']
        );
    }
}