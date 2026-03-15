# GeoTime

**GeoTime** is a PHP package that provides the current server time based on its external IP address, using public APIs. The package implements **PSR-20 `ClockInterface`** and allows fully customizable HTTP configurations.

It resolves the external IP address of the server, then fetches the current time and timezone for that IP. The architecture separates **Fetcher, Mapper, DTO, Resolver, and Clock** layers, making it clean, testable, and extendable.

---

## Installation

You can install the package using Composer:

```bash
composer require afedchuk/geo-time