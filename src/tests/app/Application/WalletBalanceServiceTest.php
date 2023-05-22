<?php

namespace Tests\app\Application;

use Exception;
use PHPUnit\Framework\TestCase;
use Mockery;
use App\Domain\Wallet;
use App\Application\WalletBalanceService;

class WalletBalanceServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletBalanceServiceMock = Mockery::mock(WalletBalanceService::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function execute_create_balance_with_no_coins_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->WalletBalanceServiceMock->shouldReceive('execute')->once()->with('1')->andThrow(new Exception("Coin Not found exception"));
        $this->WalletBalanceServiceMock->execute('1');
    }

    /**
     * @test
     */
    public function execute_create_balance_return_balance_test(){
        $this->WalletBalanceServiceMock->shouldReceive('execute')->once()->with('1')->andReturn('5000$');
        $result = $this->WalletBalanceServiceMock->execute('1');
        $this->assertEquals('5000$', $result);
    }
}
