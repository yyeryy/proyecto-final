<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;
use Mockery;


class CacheWalletDataSourceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheMock = Mockery::mock('alias:'.Cache::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function test_create_wallet()
    {
        $wallet = $this->cacheMock->shouldReceive('get')->once()->with('wallet:1')->andReturn('wallet:1');

        if(!$wallet){
            $this->cacheMock->shouldReceive('put')->once()->with('wallet:1', Mockery::type(Wallet::class));
        }

        $cacheWalletDataSource = new CacheWalletDataSource();

        $result = $cacheWalletDataSource->createWallet('1');
        $this->assertEquals('wallet:1', $result);
    }

    /**
     * @test
     */
    public function test_find_user_by_id()
    {
        $expectedWallet = new Wallet(1);

        $this->cacheMock->shouldReceive('get')->once()->with('wallet:1')->andReturn($expectedWallet);

        $cacheWalletDataSource = new CacheWalletDataSource();

        $result = $cacheWalletDataSource->findById('1');
        $this->assertEquals($expectedWallet, $result);
    }
}
