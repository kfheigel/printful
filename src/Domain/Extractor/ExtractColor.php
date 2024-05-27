<?php

declare(strict_types=1);

require_once 'src/Domain/Extractor/ExtractorInterface.php';

use App\Domain\Extractor\ExtractorInterface;

class ExtractColor implements ExtractorInterface
{
    public static function extract(array $data): array
    {
        return [
            'colors' => array_column($data['data']['colors'], 'name')
        ];
    }
}
