<?php

namespace Tests\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APIClient;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class APIClientTest extends TestCase
{
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
        $APIClient = new APIClient();
        $result = $APIClient->getCoinDataWithId('90');
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
        $APIClient = new APIClient();
        $APIClient->getCoinDataWithId('50A000');
    }
}
