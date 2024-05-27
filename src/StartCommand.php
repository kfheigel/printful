<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'src/Infrastructure/HttpClient/PrintfulClient.php';
require_once 'src/Domain/Extractor/ExtractColor.php';
require_once 'src/Domain/Extractor/ExtractSize.php';

$printfulClient = new PrintfulClient();

$productVariants = $printfulClient->getProductVariants();
$data = json_decode($productVariants, true);
$color = ExtractColor::extract($data);
$size = ExtractSize::extract($data);

echo json_encode($color) . PHP_EOL;
echo json_encode($size) . PHP_EOL;