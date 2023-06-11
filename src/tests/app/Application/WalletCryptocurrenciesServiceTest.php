<?php

namespace Tests\Application;

use App\Application\WalletCryptocurrenciesService;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;

class WalletCryptocurrenciesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function execute_create_wallet_with_existing_wallet_id_test(){
        $wallet = new Wallet('1');
        $this->cacheWalletDataSourceMock->shouldReceive('findById')->once()->with('1')->andReturn($wallet);
        $walletCryptocurrenciesService = new WalletCryptocurrenciesService($this->cacheWalletDataSourceMock);
        $result = $walletCryptocurrenciesService->execute('1');
        $this->assertEquals($wallet, $result);
    }
}
