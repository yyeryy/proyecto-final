<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheServiceProvider;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;
use Mockery;


class CacheServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function anadirUserTest()
    {
        $cacheMock = Mockery::mock('alias:'.Cache::class);
        $cacheMock->shouldReceive('get')->once()->with('last_user_id', 0)->andReturn('0');

        $cacheMock->shouldReceive('put')->once()->with('user:1', [1, '1']);

        $cacheMock->shouldReceive('put')->once()->with('last_user_id', 1)->andReturn('1');



        $cacheServiceProvider = new CacheServiceProvider();

        $result = $cacheServiceProvider->anadirUserCache();
        $this->assertEquals('1', $result);
    }

    /**
     * @test
     */
    /*public function cogerUserTest()
    {
        $cacheMock = Mockery::mock('alias:'.Cache::class);
        $cacheMock->shouldReceive('get')->once()->with('user:1')->andReturn([1, '1']);

        $expectedUser = new User(1, new Wallet('1'));

        $cacheServiceProvider = new CacheServiceProvider();

        $result = $cacheServiceProvider->cogerUserCache('1');
        $this->assertEquals([$expectedUser->getId(), $expectedUser->getWallet()->getId()], $result);
    }*/
}
