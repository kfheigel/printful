<?php

declare(strict_types=1);

namespace App\Domain\Extractor;

use App\Domain\Extractor\ExtractorInterface;

final class SizeExtractor implements ExtractorInterface
{
    public static function extract(array $data): array
    {
        return ['sizes' => isset($data['data']['sizes']) ? $data['data']['sizes'] : []];
    }
}
