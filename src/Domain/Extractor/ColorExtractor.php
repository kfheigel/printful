<?php

declare(strict_types=1);

namespace App\Domain\Extractor;

use App\Domain\Extractor\ExtractorInterface;

final class ColorExtractor implements ExtractorInterface
{
    public static function extract(array $data): array
    {
        $colors = isset($data['data']['colors']) ? $data['data']['colors'] : [];
        return [
            'colors' => array_column($colors, 'name')
        ];
    }
}
