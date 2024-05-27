<?php

declare(strict_types=1);

namespace App\Infrastructure\Cache;

use App\Domain\Cache\CacheInterface;

final class FileCache implements CacheInterface
{
    private $cacheDir;

    public function __construct($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function set(string $key, $value, int $duration): ?string
    {
        $cacheFile = $this->getCacheFile($key);
        $data = [
            'value' => $value,
            'expiry' => time() + $duration
        ];
        file_put_contents($cacheFile, serialize($data));
        return $value;
    }

    public function get(string $key): ?string
    {
        $cacheFile = $this->getCacheFile($key);
        if (!file_exists($cacheFile)) {
            return null;
        }
        $data = unserialize(file_get_contents($cacheFile));
        if (time() > $data['expiry']) {
            unlink($cacheFile);
            return null;
        }
        return $data['value'];
    }

    private function getCacheFile($key)
    {
        return sprintf('%s%s%s%s', $this->cacheDir, DIRECTORY_SEPARATOR, md5($key), '.cache');
    }
}