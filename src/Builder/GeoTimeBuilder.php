<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Builder;

use Afedchuk\GeoTime\Application\GeoTimeClock;
use Afedchuk\GeoTime\Domain\Resolver\IpResolver;
use Afedchuk\GeoTime\Domain\Resolver\TimezoneResolver;
use Afedchuk\GeoTime\Factory\ConfigFactory;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\IpFetcher;
use Afedchuk\GeoTime\Infrastructure\Provider\Time\TimeFetcher;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;

/**
 * Class GeoTimeBuilder
 *
 * Builder for constructing GeoTimeClock instances.
 */
final class GeoTimeBuilder
{
    private ?HttpConfigInterface $ipConfig = null;
    private ?HttpConfigInterface $timeConfig = null;

    public static function create(): self
    {
        return new self();
    }

    public function withIpConfig(HttpConfigInterface $config): self
    {
        $this->ipConfig = $config;
        return $this;
    }

    public function withTimeConfig(HttpConfigInterface $config): self
    {
        $this->timeConfig = $config;
        return $this;
    }

    public function build(): GeoTimeClock
    {
        $ipConfig = $this->ipConfig ?? ConfigFactory::defaultIpConfig();
        $timeConfig = $this->timeConfig ?? ConfigFactory::defaultTimeConfig();

        $ipFetcher = new IpFetcher($ipConfig);
        $timeFetcher = new TimeFetcher($timeConfig);

        $ipResolver = new IpResolver($ipFetcher);
        $timezoneResolver = new TimezoneResolver($timeFetcher);

        return new GeoTimeClock($ipResolver, $timezoneResolver);
    }
}