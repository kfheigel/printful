<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Domain\Extractor\SizeExtractor;
use App\Infrastructure\Cache\FileCache;
use App\Domain\Extractor\ColorExtractor;
use App\Infrastructure\HttpClient\PrintfulClient;

$cacheDir = __DIR__ . '/../var/cache';

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}

$fileCache = new FileCache($cacheDir);
$printfulClient = new PrintfulClient($fileCache);

$productVariants = $printfulClient->getProductVariants();
$data = json_decode($productVariants, true);
$color = ColorExtractor::extract($data);
$size = SizeExtractor::extract($data);

echo json_encode($color) . PHP_EOL;
echo json_encode($size) . PHP_EOL;