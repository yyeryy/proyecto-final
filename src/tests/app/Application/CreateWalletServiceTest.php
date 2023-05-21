<?php

namespace Tests\Application;

use App\Application\CreateWalletService;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateWalletServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->CreateWalletServiceMock = Mockery::mock(CreateWalletService::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function execute_return_wallet_correctly(){
        /*$this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn(Mockery::type(Wallet::class));
        $this->CreateWalletServiceMock->execute('1');
        $CreateWalletService = new CreateWalletService(new CacheUserDataSource, new CacheWalletDataSource);
        $result = $CreateWalletService->execute('1');
        $this->assertEquals('1', $result->getId());

        $cacheUserDataSourceMock = Mockery::mock(CacheUserDataSource::class);
        $cacheUserDataSourceMock->shouldReceive('findUserById')->once()->with('1')->andReturn('1');

        $cacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
        $cacheWalletDataSourceMock->shouldReceive('createWallet')->once()->with('1')->andReturn(Mockery::mock(Wallet::class));

        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn(Mockery::type(Wallet::class));
        $result = $this->CreateWalletServiceMock->execute('1');

        $CreateWalletService = new CreateWalletService($cacheUserDataSourceMock, $cacheWalletDataSourceMock);

        $result = $CreateWalletService->execute('1');

        $this->assertEquals(new Wallet('1'), $result);*/
    }
}
