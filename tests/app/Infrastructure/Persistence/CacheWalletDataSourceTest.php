<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheWalletDataSource;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Tests\TestCase;
use Mockery;


class CacheWalletDataSourceTest extends TestCase
{
    protected $cacheMock;
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheMock = Mockery::mock(CacheRepository::class);
    }

    /**
     * @test
     */
    public function testCreateWallet()
    {
        $wallet = $this->cacheMock->shouldReceive('get')->once()->with('wallet:1')->andReturn('wallet:1');

        if (!$wallet) {
            $this->cacheMock->shouldReceive('put')->once()->with('wallet:1', $wallet);
        }

        $cacheWallet = new CacheWalletDataSource($this->cacheMock);

        $result = $cacheWallet->createWallet('1');
        $this->assertEquals('wallet:1', $result);
    }

    /**
     * @test
     */
    public function testFindUserById()
    {
        $expectedWallet = new Wallet(1);

        $this->cacheMock->shouldReceive('get')->once()->with('wallet:1')->andReturn($expectedWallet);

        $cacheWallet = new CacheWalletDataSource($this->cacheMock);

        $result = $cacheWallet->findById('1');
        $this->assertEquals($expectedWallet, $result);
    }
}
