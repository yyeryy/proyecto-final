<?php

namespace Tests\Application;

use App\Application\BuyCoinService;
use Exception;
use Mockery;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;

class BuyCoinServiceTest extends TestCase
{
    /*protected function setUp(): void
    {
        parent::setUp();
        $this->BuyCoinServiceMock = Mockery::mock(BuyCoinService::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }*/

    /**
     * @test
     */
    /*public function execute_run_correctly_and_insert_coin_in_wallet_test(){
        $this->BuyCoinServiceMock->shouldReceive('execute')->once()->with('90', '1', 1000);
        $this->BuyCoinServiceMock->execute('90', '1', 1000);
    }*/

    /**
     * @test
     */
    /*public function execute_throw_exception_incorrectly_coin_id_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->BuyCoinServiceMock->shouldReceive('execute')->once()->with('50000', '1', 1000);
        $this->BuyCoinServiceMock->execute('50000', '1', 1000);
    }*/

    /**
     * @test
     */
    /*public function execute_throw_exception_incorrectly_wallet_id_test(){
        $this->BuyCoinServiceMock->shouldReceive('execute')->once()->with('90', '1', 1000);
        $this->BuyCoinServiceMock->execute('90', '1', 1000);
    }*/
}
