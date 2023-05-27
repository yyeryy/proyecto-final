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
    public function execute_create_wallet_with_non_existing_user_id_test(){
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('2')->andReturn(null);
        $result = $this->CreateWalletServiceMock->execute('2');
        $this->assertEquals(null, $result);
    }

    /**
     * @test
     */
    public function execute_create_wallet_with_existing_user_id_test(){
        $wallet = new Wallet('1');
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn($wallet);
        $result = $this->CreateWalletServiceMock->execute('1');
        $this->assertEquals($wallet, $result);
    }
}
