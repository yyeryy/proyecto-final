<?php

namespace Tests\app\Infrastructure\Persistence;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Persistence\CacheServiceProvider;

class CacheServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function anadirUserTest()
    {
        $cacheServiceProvider = new CacheServiceProvider();
        $resultado = $cacheServiceProvider->cogerUserCache(1);
        $this->assertSame('1', $resultado);

        /*$cacheServiceProvider = new CacheServiceProvider();
        $resultado = $cacheServiceProvider->anadirUserCache();
        $this->assertSame('1', $resultado);*/
    }
}
