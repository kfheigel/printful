<?php

declare(strict_types=1);

class ExtractColor
{
    public static function extract(array $data): array
    {
        return [
            'colors' => array_column($data['data']['colors'], 'name')
        ];
    }
}
