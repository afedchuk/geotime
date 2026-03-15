<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper\IpMapper;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

final class IpFetcher implements IpFetcherInterface
{
    private readonly IpMapper $mapper;

    public function __construct(private readonly HttpConfigInterface $config)
    {
        $this->mapper = new IpMapper();
    }

    /**
     * Fetch IP DTO.
     */
    public function fetchIp(): IpDto
    {
        $response = $this->fetchRaw();
        
        // Decode JSON body to array
        $data = json_decode($response->getBody()->getContents(), true);
        
        return $this->mapper->map($data);
}

    /**
     * Fetch raw HTTP response from IP API.
     */
    public function fetchRaw(): ResponseInterface
    {
        $client = new Client([
            'base_uri' => rtrim($this->config->getHost(), '/') . '/',
            'timeout'  => $this->config->getTimeout(),
        ]);

        /** @var ResponseInterface $response */
        $response = $client->request('GET', ltrim($this->config->getPath(), '/'), [
            'headers' => $this->config->getHeaders(),
            'query'   => $this->config->getParameters(),
        ]);

        return $response;
    }
}