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
        $expected = '90';
        $this->assertSame($expected, $resultado);
    }

    /**
     * @test
     */
    public function apiCoin()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->Coin(90);
        $expected = 'Bitcoin';
        $this->assertSame($expected, $resultado);
    }

    /**
     * @test
     */
    public function apiCoinPrice()
    {
        $apiServiceProvider = new APIServiceProvider();
        $resultado = $apiServiceProvider->Coin(90);
        $expected = 'Bitcoin';
        $this->assertSame($expected, $resultado);
    }
}
