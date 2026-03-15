<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip;

use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;
use Psr\Http\Message\ResponseInterface;

interface IpFetcherInterface
{
    /**
     * Fetch the external IP and return as DTO.
     *
     * @return IpDto
     */
    public function fetchIp(): IpDto;

    /**
     * Fetch raw HTTP response from IP API.
     *
     * @return ResponseInterface
     */
    public function fetchRaw(): ResponseInterface;
}