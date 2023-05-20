<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APIClient;
use PHPUnit\Framework\TestCase;

class APIServiceProviderTest extends TestCase
{

    /**
     * @test
     */
    public function apiCoinTest()
    {
        $apiServiceProvider = new APIClient();
        $resultado = $apiServiceProvider->getCoinDataWithId(90);
        $this->assertSame('90', $resultado[0]['id']);
    }

}
