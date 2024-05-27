<?php

declare(strict_types=1);

use App\InfraStructure\Cache\FileCache;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Infrastructure/HttpClient/PrintfulClient.php';
require_once __DIR__ . '/Domain/Extractor/ExtractColor.php';
require_once __DIR__ . '/Domain/Extractor/ExtractSize.php';
require_once __DIR__ . '/Domain/Cache/CacheInterface.php';
require_once __DIR__ . '/Infrastructure/Cache/FileCache.php';

$cacheDir = __DIR__ . '/../var/cache';

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0777, true);
}

$fileCache = new FileCache($cacheDir);
$printfulClient = new PrintfulClient($fileCache);

$productVariants = $printfulClient->getProductVariants();
$data = json_decode($productVariants, true);
$color = ExtractColor::extract($data);
$size = ExtractSize::extract($data);

echo json_encode($color) . PHP_EOL;
echo json_encode($size) . PHP_EOL;