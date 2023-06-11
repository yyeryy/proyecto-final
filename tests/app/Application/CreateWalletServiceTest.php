<?php

namespace Tests\Application;

use App\Application\CreateWalletService;
use App\Domain\User;
use App\Domain\UserDataSource;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateWalletServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->CacheUserDataSourceMock = Mockery::mock(CacheUserDataSource::class);
        $this->CacheWalletDataSourceMock = Mockery::mock(CacheWalletDataSource::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function execute_create_wallet_with_non_existing_user_id_test(){
        $this->CacheUserDataSourceMock->shouldReceive('findUserById')->once()->with('2')->andReturn(null);
        $createWalletService = new CreateWalletService($this->CacheUserDataSourceMock, $this->CacheWalletDataSourceMock);

        $this->expectException(\Exception::class);

        $createWalletService->execute('2');
    }

    /**
     * @test
     */
    public function execute_create_wallet_with_existing_user_id_test(){
        $wallet = new Wallet('1');
        $user = new User('1', $wallet);

        if($this->CacheUserDataSourceMock->shouldReceive('findUserById')->once()->with('1')->andReturn($user)){
            $this->CacheWalletDataSourceMock->shouldReceive('createWallet')->once()->with('1')->andReturn($wallet);
        }
        $createWalletService = new CreateWalletService($this->CacheUserDataSourceMock, $this->CacheWalletDataSourceMock);

        $result = $createWalletService->execute('1');
        $this->assertEquals($wallet, $result);
    }
}
