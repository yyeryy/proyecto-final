<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APIClient;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\Persistence\APIServiceProvider;

class APIServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function apiCoinsTest()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->get100CoinsData();
        $this->assertSame('90', $resultado["data"][0]["id"]);
    }

    /**
     * @test
     */
    public function apiCoinTest()
    {
        $apiServiceProvider = new APIClient();
        $resultado = $apiServiceProvider->getCoinDataWithId(90);
        $this->assertSame('Bitcoin', $resultado[0]['id']);
    }

}
