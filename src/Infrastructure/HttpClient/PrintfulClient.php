<?php

declare(strict_types=1);

require_once 'src/Domain/HttpClient/PrintfulClientInterface.php';
require_once 'src/Infrastructure/HttpClient/Factory/ClientFactory.php';

use GuzzleHttp\Exception\GuzzleException;
use App\Domain\HttpClient\PrintfulClientInterface;

class PrintfulClient implements PrintfulClientInterface
{
    private string $productId = '12';
    private string $sellingRegionName = 'worldwide';

    public function getProductVariants(): ?string
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