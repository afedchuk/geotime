<?php

declare(strict_types=1);

namespace Afedchuk\GeoTime\Infrastructure\Provider\Ip;

use Afedchuk\GeoTime\Infrastructure\Http\Config\HttpConfigInterface;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Dto\IpDto;
use Afedchuk\GeoTime\Infrastructure\Provider\Ip\Mapper\IpMapper;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Fetches external IP address from an API.
 *
 * Encapsulates HTTP request execution and mapping of raw API response
 * into a typed IpDto object.
 */
final class IpFetcher implements IpFetcherInterface
{
    /**
     * Mapper for converting API response array into IpDto.
     */
    private readonly IpMapper $mapper;

    /**
     * Constructor.
     *
     * @param HttpConfigInterface $config HTTP configuration for IP API
     */
    public function __construct(
        private readonly HttpConfigInterface $config
    ) {
        $this->mapper = new IpMapper();
    }

    /**
     * Fetch external IP address as a DTO.
     *
     * @return IpDto
     *
     * @throws \RuntimeException If API response is invalid
     */
    #[\Pure]
    public function fetchIp(): IpDto
    {
        $response = $this->fetchRaw();

        // Decode JSON response to associative array
        $data = json_decode($response->getBody()->getContents(), true);

        if (!is_array($data)) {
            throw new \RuntimeException('Invalid API response: expected JSON object.');
        }

        return $this->mapper->map($data);
    }

    /**
     * Execute raw HTTP request to IP API.
     *
     * @return ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchRaw(): ResponseInterface
    {
        $client = new Client([
            'base_uri' => rtrim($this->config->getHost(), '/') . '/',
            'timeout'  => $this->config->getTimeout(),
        ]);

        /** @var ResponseInterface $response */
        $response = $client->request(
            'GET',
            ltrim($this->config->getPath(), '/'),
            [
                'headers' => $this->config->getHeaders(),
                'query'   => $this->config->getParameters(),
            ]
        );

        return $response;
    }
}