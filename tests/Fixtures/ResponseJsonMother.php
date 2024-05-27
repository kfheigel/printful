<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

final class ResponseJsonMother
{
    public static function create(): string
    {
        $responseContent = file_get_contents(__DIR__ . '/Response/response.json');


        return $responseContent ?: '';
    }
}
