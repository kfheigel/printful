<?php

declare(strict_types=1);

require_once 'src/Domain/Extractor/ExtractorInterface.php';

use App\Domain\Extractor\ExtractorInterface;

class ExtractSize implements ExtractorInterface
{
    public static function extract(array $data): array
    {
        return [
            'sizes' => $data['data']['sizes']
        ];
    }
}
