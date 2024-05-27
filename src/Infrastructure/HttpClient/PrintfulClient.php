<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient;

use App\Domain\Cache\CacheInterface;
use GuzzleHttp\Exception\GuzzleException;
use App\Domain\Config\PrintfulClientConfig;
use App\Domain\HttpClient\PrintfulClientInterface;
use App\Infrastructure\HttpClient\Factory\ClientFactory;

final class PrintfulClient implements PrintfulClientInterface
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getProductVariants(): ?string
    {
        $cachedResponse = $this->cache->get(PrintfulClientConfig::CACHE_KEY);
        
        if ($cachedResponse !== null) {
            return $cachedResponse;
        }

        $response = $this->apiRequest();

        $this->cache->set(PrintfulClientConfig::CACHE_KEY, $response, 300);

        return $response;
    }

    private function apiRequest()
    {
        $printfulClient = ClientFactory::createHttpClient();
        
        try {
            $response = $printfulClient->get(PrintfulClientConfig::PRODUCT_ID, [
                'query' => [
                    'selling_region_name' => PrintfulClientConfig::SELLING_REGION_NAME,
                ],
            ]);

            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            return null;
        }
    }
}