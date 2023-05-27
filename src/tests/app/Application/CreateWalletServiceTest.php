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
        //$this->CreateWalletServiceMock = Mockery::mock(CreateWalletService::class);
        $this->UserDataSourceMock = Mockery::mock(UserDataSource::class);
        $this->WalletDataSourceMock = Mockery::mock(WalletDataSource::class);
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
        $this->UserDataSourceMock->shouldReceive('findUserById')->once()->with('2')->andReturn(null);
        $createWalletService = new CreateWalletService($this->UserDataSourceMock, $this->WalletDataSourceMock);

        $this->expectException(\Exception::class);

        $createWalletService->execute('2');
        /*$this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('2')->andReturn(null);
        $result = $this->CreateWalletServiceMock->execute('2');*/
    }

    /**
     * @test
     */
    public function execute_create_wallet_with_existing_user_id_test(){
        $wallet = new Wallet('1');
        $user = new User('1', $wallet);
        if($this->UserDataSourceMock->shouldReceive('findUserById')->once()->with('1')->andReturn($user)){
            $this->WalletDataSourceMock->shouldReceive('createWallet')->once()->with('1')->andReturn($wallet);
        }
        $createWalletService = new CreateWalletService($this->UserDataSourceMock, $this->WalletDataSourceMock);

        $result = $createWalletService->execute('1');
        $this->assertEquals($wallet, $result);
        /*$wallet = new Wallet('1');
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn($wallet);
        $result = $this->CreateWalletServiceMock->execute('1');
        $this->assertEquals($wallet, $result);*/
    }
}
