<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Factory;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfig;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;

/**
 * Class ConfigFactory
 *
 * Provides default HTTP configurations for IP and Time APIs.
 */
final class ConfigFactory
{
    public static function defaultIpConfig(): HttpConfigInterface
    {
        return new HttpConfig(
            'https://api.ipify.org',
            '/',
            ['Accept' => 'application/json'],
            ['format' => 'json']
        );
    }

    public static function defaultTimeConfig(): HttpConfigInterface
    {
        return new HttpConfig(
            'https://timeapi.io',
            '/api/Time/current/ip',
            ['Accept' => 'application/json']
        );
    }
}