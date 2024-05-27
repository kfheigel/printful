<?php

declare(strict_types=1);

class ExtractSize
{
    public static function extract(array $data): array
    {
        return [
            'sizes' => $data['data']['sizes']
        ];
    }
}
