<?php
declare(strict_types=1);

namespace Afedchuk\GeoTime\Builder;

use Afedchuk\GeoTime\Application\GeoTimeClock;
use Afedchuk\GeoTime\Domain\Resolver\IpResolver;
use Afedchuk\GeoTime\Domain\Resolver\TimezoneResolver;
use Afedchuk\GeoTime\Factory\ConfigFactory;
use Afedchuk\GeoTime\Infrastructure\Http\Client\HttpClient;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\IpFetcher;
use Afedchuk\GeoTime\Infrastructure\Provider\Time\TimeFetcher;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\StaticIpFetcher;

/**
 * Builder for constructing GeoTimeClock instances.
 */
final class GeoTimeBuilder
{
    private ?HttpConfigInterface $ipConfig = null;
    private ?HttpConfigInterface $timeConfig = null;
    private ?string $customIp = null;

    /**
     * Create builder instance.
     */
    public static function create(): self
    {
        return new self();
    }

     /**
     * Override configuration used to resolve static IP.
     */
    public function withIp(string $ip): self
    {
        $this->customIp = $ip;

        return $this;
    }

    /**
     * Override configuration used to resolve server external IP.
     */
    public function withIpConfig(HttpConfigInterface $config): self
    {
        $this->ipConfig = $config;
        return $this;
    }
    

    /**
     * Override configuration used to resolve timezone by IP.
     */
    public function withTimeConfig(HttpConfigInterface $config): self
    {
        $this->timeConfig = $config;
        return $this;
    }

    /**
     * Build GeoTimeClock instance.
     */
    public function build(): GeoTimeClock
    {
        $ipFetcher = $this->customIp
        ? new StaticIpFetcher($this->customIp)
        : new IpFetcher($this->ipConfig ?? ConfigFactory::defaultIpConfig());

        $timeFetcher = new TimeFetcher(
            $this->timeConfig ?? ConfigFactory::defaultTimeConfig()
        );

        $ipResolver = new IpResolver($ipFetcher);
        $timezoneResolver = new TimezoneResolver($timeFetcher);

        return new GeoTimeClock(
            $ipResolver,
            $timezoneResolver
        );
    }
}