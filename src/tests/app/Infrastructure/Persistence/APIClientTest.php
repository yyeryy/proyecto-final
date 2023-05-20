<?php

namespace Tests\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APIClient;
use Exception;
use PHPUnit\Framework\TestCase;

class APIClientTest extends TestCase
{
    /**
     * @test
     */
    public function get_coin_data_with_Id_correctly_test(){
        $APIClient = new APIClient();
        $data = $APIClient->getCoinDataWithId(90);
        $this->assertNotNull($data);
        $this->assertIsArray($data);
        $this->assertEquals('Bitcoin', $data[0]['name']);
    }
    /**
     * @test
     */
    public function get_coin_data_with_incorrectly_Id_test(){
        $APIClient = new APIClient();
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $APIClient->getCoinDataWithId(50000);
    }
}
