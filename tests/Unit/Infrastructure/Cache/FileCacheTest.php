<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Cache;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\Cache\FileCache;

final class FileCacheTest extends TestCase
{
    private $cacheDir;

    protected function setUp(): void
    {
        $this->cacheDir = sys_get_temp_dir() . '/file_cache_test';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir);
        }
    }

    protected function tearDown(): void
    {
        array_map('unlink', glob("$this->cacheDir/*"));
        rmdir($this->cacheDir);
    }

    /** @test */
    public function set_cache_and_get_a_value(): void
    {
        // given
        $givenKey = 'givenKey';
        $givenValue = 'givenValue';
        $cache = new FileCache($this->cacheDir);

        // when
        $cache->set($givenKey, $givenValue, 3600);

        // then
        $this->assertSame($givenValue, $cache->get($givenKey));
    }

    /** @test */
    public function returns_null_for_non_existing_key(): void
    {
        // given
        $cache = new FileCache($this->cacheDir);

        // then
        $this->assertNull($cache->get('non_existing_key'));
    }

    /** @test */
    public function expire_value(): void
    {
        // given
        $givenKey = 'givenKey';
        $givenValue = 'givenValue';
        $cache = new FileCache($this->cacheDir);
        
        // when
        $cache->set($givenKey, $givenValue, 1);
        sleep(2);

        // then
        $this->assertNull($cache->get($givenKey));
    }

    /** @test */
    public function delete_expired_file(): void
    {
        // given
        $givenKey = 'givenKey';
        $givenValue = 'givenValue';
        $cache = new FileCache($this->cacheDir);
        $cache->set($givenKey, $givenValue, 1);
        sleep(2);

        // when
        $cache->get($givenKey);
        $cacheFile = $this->cacheDir . DIRECTORY_SEPARATOR . md5($givenKey) . '.cache';
        
        // then
        $this->assertFileDoesNotExist($cacheFile);
    }
}
