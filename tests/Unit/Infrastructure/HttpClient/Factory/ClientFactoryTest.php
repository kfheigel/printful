<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\HttpClient\Factory;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\HttpClient\Factory\ClientFactory;

final class ClientFactoryTest extends TestCase
{
    /** @test */
    public function creates_http_client_with_correct_base_uri()
    {
        $client = ClientFactory::createHttpClient();

        $config = $client->getConfig();
        $this->assertArrayHasKey('base_uri', $config);
        $this->assertSame('https://api.printful.com/v2/catalog-products/', (string)$config['base_uri']);
    }

    /** @test */
    public function creates_http_client_with_correct_authorization_header()
    {
        $client = ClientFactory::createHttpClient();

        $config = $client->getConfig();
        $this->assertArrayHasKey('headers', $config);
        $this->assertArrayHasKey('Authorization', $config['headers']);
        $this->assertSame('Bearer TFkvAKUKxz5JoGMkXlblfxQg56diCh70pe2TmEfD', $config['headers']['Authorization']);
    }
}
