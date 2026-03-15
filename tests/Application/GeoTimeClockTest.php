<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Tests\Application;

use PHPUnit\Framework\TestCase;
use Psr\Clock\ClockInterface;
use Afedchuk\GeoTime\Application\GeoTimeClock;
use Afedchuk\GeoTime\Domain\Resolver\IpResolver;
use Afedchuk\GeoTime\Domain\Resolver\TimezoneResolver;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\IpFetcherInterface;
use Afedchuk\GeoTime\Infrastructure\Provider\Time\TimeFetcherInterface;

/**
 * Class GeoTimeClockTest
 */
class GeoTimeClockTest extends TestCase
{
    public function testNowReturnsDateTimeImmutable(): void
    {
        $ip = '123.123.123.123';
        $timezone = 'Europe/Kiev';

        // Mock IpFetcherInterface
        $ipFetcherMock = $this->createMock(IpFetcherInterface::class);
        $ipFetcherMock->expects($this->once())
                      ->method('fetchIp')
                      ->willReturn(new IpDto($ip));

        $ipResolverMock = new IpResolver($ipFetcherMock);

        // Mock TimeFetcherInterface
        $timeFetcherMock = $this->createMock(TimeFetcherInterface::class);
        $timeFetcherMock->expects($this->once())
                        ->method('fetchTimezone')
                        ->with($ip)
                        ->willReturn($timezone);

        $timezoneResolverMock = new TimezoneResolver($timeFetcherMock);

        $geoTimeClock = new GeoTimeClock(
            $ipResolverMock,
            $timezoneResolverMock
        );

        $result = $geoTimeClock->now();

        $this->assertInstanceOf(\DateTimeImmutable::class, $result);
        $this->assertSame($timezone, $result->getTimezone()->getName());
    }
}