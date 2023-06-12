<?php

namespace Tests\Application;

use App\Application\WalletCryptocurrenciesService;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class WalletCryptocurrenciesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
    }

    /**
     * @test
     */
    public function executeCreateWalletWithExistingWalletIdTest()
    {
        $wallet = new Wallet('1');
        $this->cacheWalletDataSourceMock->shouldReceive('findById')->once()->with('1')->andReturn($wallet);
        $walletService = new WalletCryptocurrenciesService($this->cacheWalletDataSourceMock);
        $result = $walletService->execute('1');
        $this->assertEquals($wallet, $result);
    }
}
