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
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
        $this->APICoinDataSourceMock = Mockery::mock(APICoinDataSource::class);
        $this->WalletMock = Mockery::mock(Wallet::class);
        $app = require '/opt/project/src//bootstrap/app.php';

        $app->loadEnvironmentFrom('.env.testing');
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        $this->app = $app;
        $this->app->instance('cache', $this->app['cache']->driver());
        Cache::setFacadeApplication($this->app);
    }
    protected function tearDown(): void
    {
        Cache::clearResolvedInstances();
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function execute_create_wallet_with_existing_wallet_id_test(){
        $wallet = new Wallet('1');
        $walletId = '1';
        $coin = new Coin(90, 'Bitcoin', 'BTC', 2, 500, 1);
        $this->cacheWalletDataSourceMock->shouldReceive('findById')->once()->with('1')->andReturn($this->WalletMock);
        $this->APICoinDataSourceMock->shouldReceive('getById')->once()->with('90', 500)->andReturn($coin);
        $this->WalletMock->shouldReceive('insertCoin')->once()->with($coin);
        $buyCoinService = new BuyCoinService($this->cacheWalletDataSourceMock, $this->APICoinDataSourceMock);
        $buyCoinService->execute(90, '1', 500);
        $cachedWallet = Cache::get('wallet:' . $walletId);
        $this->assertSame($this->WalletMock, $cachedWallet);
    }
}
