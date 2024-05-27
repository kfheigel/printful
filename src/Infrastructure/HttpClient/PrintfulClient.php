<?php

declare(strict_types=1);

require_once 'src/Domain/HttpClient/PrintfulClientInterface.php';
require_once 'src/Infrastructure/HttpClient/Factory/ClientFactory.php';

use App\Domain\Cache\CacheInterface;
use GuzzleHttp\Exception\GuzzleException;
use App\Domain\HttpClient\PrintfulClientInterface;

class PrintfulClient implements PrintfulClientInterface
{
    private string $productId = '12';
    private string $sellingRegionName = 'worldwide';
    private string $cacheKey = 'product_variants_api_response';

    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    public function getProductVariants(): ?string
    {
        $cachedResponse = $this->cache->get($this->cacheKey);
        
        if ($cachedResponse !== null) {
            return $cachedResponse;
        }

        $response = $this->apiRequest();

        $this->cache->set($this->cacheKey, $response, 300);

        return $response;
    }

    private function apiRequest()
    {
        $printfulClient = ClientFactory::createHttpClient();
        
        try {
            $response = $printfulClient->get($this->productId, [
                'query' => [
                    'selling_region_name' => $this->sellingRegionName,
                ],
            ]);

            return $response->getBody()->getContents();
        } catch (GuzzleException $e) {
            return null;
        }
    }
}