<?php

namespace Tests\app\Application;

use App\Domain\Coin;
use App\Domain\CoinDataSource;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Exception;
use PHPUnit\Framework\TestCase;
use Mockery;
use App\Domain\Wallet;
use App\Application\WalletBalanceService;

class WalletBalanceServiceTest extends TestCase
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function setUp(): void
    {
        parent::setUp();
        //$this->WalletBalanceServiceMock = Mockery::mock(WalletBalanceService::class);
        $this->APICoinDataSourceMock = Mockery::mock(APICoinDataSource::class);
        $this->CacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
    }

    /**
     * @test
     */
    public function executeCreateBalanceWithNoCoinsTest()
    {
        $wallet = new Wallet('1');
        $this->CacheWalletDataSourceMock->shouldReceive('findById')
            ->once()
            ->with('1')
            ->andReturn($wallet);
        $walletBalanceService = new WalletBalanceService(
            $this->CacheWalletDataSourceMock,
            $this->APICoinDataSourceMock
        );

        $this->expectException(\Exception::class);

        $walletBalanceService->execute('1');
    }

    /**
     * @test
     */
    public function executeCreateBalanceReturnBalanceTest()
    {
        $wallet = new Wallet('1');
        $coin = new Coin(90, 'Bitcoin', 'BTC', 2, 500, 1);
        $wallet->insertCoin($coin);
        $this->CacheWalletDataSourceMock->shouldReceive('findById')
            ->once()
            ->with('1')
            ->andReturn($wallet);
        $this->APICoinDataSourceMock->shouldReceive('getBalanceById')
            ->once()
            ->with('90,0')
            ->andReturn('500');

        $walletBalanceService = new WalletBalanceService(
            $this->CacheWalletDataSourceMock,
            $this->APICoinDataSourceMock
        );

        $response = $walletBalanceService->execute('1');
        $this->assertEquals('-490$', $response);
    }
}
