<?php

declare(strict_types=1);

namespace App\Tests\Fixtures;

final class ResponseJsonMother
{
    public static function create(): array
    {
        $responseContent = file_get_contents(__DIR__ . '/Response/response.json');

        $content = json_decode($responseContent, true);

        return $content ?: [];
    }
}
