<?php

namespace Tests\app\Application;

use App\Application\BuyCoinService;
use App\Domain\Coin;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Cache;

class BuyCoinServiceTest extends TestCase
{
    /**
     * @test
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function executeBuyCoinWithNotExistingWalletIdTest()
    {
        $this->cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
        $this->APICoinDataSourceMock = Mockery::mock(APICoinDataSource::class);

        $this->cacheWalletDataSourceMock->shouldReceive('findById')
            ->once()
            ->with('2')
            ->andReturn(null);

        $buyCoinService = new BuyCoinService($this->cacheWalletDataSourceMock, $this->APICoinDataSourceMock);

        $this->expectException(\Exception::class);

        $buyCoinService->execute(90, '2', 500);
    }

    /**
     * @test
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function executeBuyCoinWithExistingWalletIdTest()
    {
        $wallet = new Wallet('1');
        $walletId = '1';
        $coin = new Coin(90, 'Bitcoin', 'BTC', 2, 500, 1);

        $this->cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
        $this->APICoinDataSourceMock = Mockery::mock(APICoinDataSource::class);
        $this->WalletMock = Mockery::mock(Wallet::class);
        $this->cacheMock = Mockery::mock('alias:' . Cache::class);

        $this->cacheWalletDataSourceMock->shouldReceive('findById')
            ->once()
            ->with('1')
            ->andReturn($this->WalletMock);
        $this->APICoinDataSourceMock->shouldReceive('getById')
            ->once()
            ->with('90', 500)
            ->andReturn($coin);
        $this->WalletMock->shouldReceive('insertCoin')
            ->once()
            ->with($coin);
        $this->cacheMock->shouldReceive('put')
            ->once()
            ->with('wallet:' . $walletId, Mockery::type(Wallet::class));
        $this->cacheMock->shouldReceive('get')
            ->once()
            ->with('wallet:' . $walletId)->andReturn($wallet);

        $buyCoinService = new BuyCoinService($this->cacheWalletDataSourceMock, $this->APICoinDataSourceMock);
        $buyCoinService->execute(90, '1', 500);

        $cachedWallet = $this->cacheMock->get('wallet:' . $walletId);
        $this->assertSame($cachedWallet, $wallet);
    }
}
