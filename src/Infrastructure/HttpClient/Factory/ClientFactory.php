<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient\Factory;

use GuzzleHttp\Client;
use App\Domain\Config\ClientFactoryConfig;

class ClientFactory
{
    public static function createHttpClient(): Client
    {

        return new Client([
            'base_uri' => ClientFactoryConfig::ENDPOINT,
            'headers' => [
                'Authorization' => 'Bearer ' . ClientFactoryConfig::OAUTH_TOKEN,
            ],
        ]);
    }
}
