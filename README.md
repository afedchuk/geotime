# GeoTime

**GeoTime** is a PHP package that provides the current server time based on its external IP address, using public APIs. The package implements **PSR-20 `ClockInterface`** and allows fully customizable HTTP configurations.

It resolves the external IP address of the server, then fetches the current time and timezone for that IP. The architecture separates **Fetcher, Mapper, DTO, Resolver, and Clock** layers, making it clean, testable, and extendable.

---

## Installation

You can install the package using Composer:

```bash
composer require afedchuk/geotime
```

##  Features

- Resolve server external IP automatically.
- Fetch timezone based on IP using external APIs (e.g., [ipify](https://www.ipify.org/), [timeapi.io](https://timeapi.io/), [ipgeolocation.io](https://ipgeolocation.io/)).
- Returns current time as a `DateTimeImmutable` in server timezone.
- Fully configurable API endpoints, headers, parameters, and timeouts.
- Supports API keys for premium services.

## Usage 

```

use Afedchuk\GeoTime\Builder\GeoTimeBuilder;
$geoClock = GeoTimeBuilder::create()->build();

$currentTime = $geoClock->now();

echo "Current server time: " . $currentTime->format('Y-m-d H:i:s') . "\n";
```

Custom API Configuration

```
use Afedchuk\GeoTime\Factory\ConfigFactory;
use Afedchuk\GeoTime\Builder\GeoTimeBuilder;
use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfig;

// Custom IP API config
$ipConfig = new HttpConfig(
    'https://api.ipify.org',
    '/',
    ['Accept' => 'application/json'],
    ['format' => 'json']
);

// Custom Time API config with API key
$timeConfig = new HttpConfig(
    'https://api.ipgeolocation.io',
    '/v2/ipgeo',
    ['Accept' => 'application/json'],
    ['apiKey' => 'YOUR_API_KEY_HERE']
);

$geoClock = GeoTimeBuilder::create()
    ->withIpConfig($ipConfig)
    ->withTimeConfig($timeConfig)
    ->build();

echo $geoClock->now()->format('Y-m-d H:i:s');
```

## Testing

```
vendor/bin/phpunit
```