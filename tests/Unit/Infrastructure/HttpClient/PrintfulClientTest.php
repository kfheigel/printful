<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\HttpClient;

use ReflectionClass;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use App\Domain\Cache\CacheInterface;
use PHPUnit\Framework\Attributes\Test;
use App\Tests\Fixtures\ResponseJsonMother;
use App\Domain\Config\PrintfulClientConfig;
use App\Infrastructure\HttpClient\PrintfulClient;
use App\Infrastructure\HttpClient\Factory\ClientFactory;

final class PrintfulClientTest extends TestCase
{
    private $cacheMock;
    private $clientMock;
    private $printfulClient;

    protected function setUp(): void
    {
        $this->cacheMock = $this->createMock(CacheInterface::class);
        $this->clientMock = $this->createMock(Client::class);

        $this->printfulClient = new PrintfulClient($this->cacheMock);

        $this->replaceClientFactory();
    }

    private function replaceClientFactory()
    {
        $reflection = new ReflectionClass(ClientFactory::class);
        $method = $reflection->getMethod('createHttpClient');
        $method->setAccessible(true);

        $method->setAccessible(true);
        $method->invoke(null, function() {
            return $this->clientMock;
        });
    }

    /** @test */
    public function return_cached_response_if_available()
    {
        // given
        $givenCachedResponse = 'cached_response';
        $this->cacheMock->method('get')
            ->with(PrintfulClientConfig::CACHE_KEY)
            ->willReturn($givenCachedResponse);

        // when
        $result = $this->printfulClient->getProductVariants();

        // then
        $this->assertSame($givenCachedResponse, $result);
    }

    /** @test */
    public function fetch_product_variants_and_cache_response()
    {
        //given 
        $givenApiResponse = ResponseJsonMother::create();
        $response = new Response(200, [], $givenApiResponse);

        // when
        $this->cacheMock->method('get')
            ->with(PrintfulClientConfig::CACHE_KEY)
            ->willReturn(null);

        // and
        $this->clientMock->method('get')
            ->with(PrintfulClientConfig::PRODUCT_ID, ['query' => ['selling_region_name' => PrintfulClientConfig::SELLING_REGION_NAME]])
            ->willReturn($response);
        // and
        $this->cacheMock->expects($this->once())
            ->method('set')
            ->with(PrintfulClientConfig::CACHE_KEY, $givenApiResponse, 300);

        $result = $this->printfulClient->getProductVariants();

        // then
        $this->assertSame($givenApiResponse, $result);
    }
}
