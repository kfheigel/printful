<?php

declare(strict_types=1);

namespace App\Infrastructure\HttpClient\Factory;

use GuzzleHttp\Client;

final class ClientFactory
{
    public static function createHttpClient(): Client
    {
        $endpoint = 'https://api.printful.com/v2/catalog-products/';
        $oauthToken = 'TFkvAKUKxz5JoGMkXlblfxQg56diCh70pe2TmEfD';

        return new Client([
            'base_uri' => $endpoint,
            'headers' => [
                'Authorization' => 'Bearer ' . $oauthToken,
            ],
        ]);
    }
}
