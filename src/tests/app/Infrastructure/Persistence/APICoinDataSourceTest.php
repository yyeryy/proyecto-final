<?php

namespace Tests\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Infrastructure\Persistence\APICoinDataSource;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class APICoinDataSourceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->APICoinDataSourceMock = Mockery::mock(APICoinDataSource::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function get_coin_by_Id_correctly_test(){
        $moneda = new Coin(1, 'Bitcoin', 'BTC', 0.02, 1000, 1);
        $this->APICoinDataSourceMock->shouldReceive('getById')->once()->with('90', 1000)->andReturn($moneda);

        $result = $this->APICoinDataSourceMock->getById('90', 1000);
        $expectedCoin = new Coin(1, 'Bitcoin', 'BTC', 0.02, 1000, 1);
        $this->assertEquals($expectedCoin->getName(), $result->getName());
    }

    /**
     * @test
     */
    public function get_coin_by_incorrectly_Id_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->APICoinDataSourceMock->shouldReceive('getById')->once()->with('50000', 1000)->andThrow(new Exception("Coin Not found exception"));
        $this->APICoinDataSourceMock->getById('50000', 1000);
    }

    /**
     * @test
     */
    public function get_balance_by_Id_correctly_test(){
        $coinData = [1000, 1000];
        $this->APICoinDataSourceMock->shouldReceive('getBalanceById')->once()->with('80,90')->andReturn($coinData);
        $result = $this->APICoinDataSourceMock->getBalanceById('80,90');

        $this->assertIsArray($result);
        $this->assertEquals(2, count($result));
    }

    /**
     * @test
     */
    public function get_balance_by_incorrectly_Id_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->APICoinDataSourceMock->shouldReceive('getBalanceById')->once()->with('50000,50000')->andThrow(new Exception("Coin Not found exception"));
        $this->APICoinDataSourceMock->getBalanceById('50000,50000');
    }
}
