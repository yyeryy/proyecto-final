<?php

namespace Tests\app\Infrastructure\Persistence;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\Persistence\APIServiceProvider;

class APIServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function apiCoins()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->Coins();
        $this->assertSame('90', $resultado["data"][0]["id"]);
    }

    /**
     * @test
     */
    public function apiCoin()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->Coin(90);
        $this->assertSame('Bitcoin', $resultado[0]["name"]);
    }

    /**
     * @test
     */
    public function apiCoinPrice()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->Coin(90);
        $this->assertSame('27475.20', $resultado[0]["price_usd"]);
    }
}
