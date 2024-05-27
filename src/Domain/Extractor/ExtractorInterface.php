<?php

declare(strict_types=1);

namespace App\Domain\Extractor;

interface ExtractorInterface
{
    public static function extract(array $data): array;
}
