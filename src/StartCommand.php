<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'src/Infrastructure/HttpClient/PrintfulClient.php';
require_once 'src/Domain/Extractor/ExtractColor.php';
require_once 'src/Domain/Extractor/ExtractSize.php';
require_once 'src/Domain/Cache/CacheInterface.php';
require_once 'src/Infrastructure/Cache/FileCache.php';

$cacheDir = __DIR__ . '/cache';

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