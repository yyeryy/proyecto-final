<?php

namespace Tests\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APIClient;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class APIClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->APIClientMock = Mockery::mock(APIClient::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function get_coin_data_with_Id_correctly_test(){
        $coinData = [
            [
                'id' => 90,
                'name' => 'Bitcoin',
                'symbol' => 'BTC',
                'price_usd' => 1000,
                'rank' => 1
            ]
        ];
        $this->APIClientMock->shouldReceive('getCoinDataWithId')->once()->with('90')->andReturn($coinData);
        $result = $this->APIClientMock->getCoinDataWithId('90');
        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertEquals('Bitcoin', $result[0]['name']);
    }
    /**
     * @test
     */
    public function get_coin_data_with_incorrectly_Id_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->APIClientMock->shouldReceive('getCoinDataWithId')->once()->with('50000')->andThrow(new Exception("Coin Not found exception"));
        $result = $this->APIClientMock->getCoinDataWithId('50000');
    }
}
