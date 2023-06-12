<?php

namespace Tests\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Infrastructure\Persistence\APIClient;
use App\Infrastructure\Persistence\APICoinDataSource;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class APICoinDataSourceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->APIClientMock = Mockery::mock(APIClient::class);
    }

    /**
     * @test
     */
    public function getCoinByIdCorrectlyTest()
    {
        $APICoinDataSource = new APICoinDataSource($this->APIClientMock);
        $moneda = [[
            'id' => 1,
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
            'price_usd' => 0.02,
            'rank' => 1
        ]];
        $this->APIClientMock->shouldReceive('getCoinDataWithId')
            ->once()
            ->with('90')
            ->andReturn($moneda);
        $result = $APICoinDataSource->getById('90', 1000);
        $expectedCoin = new Coin(1, 'Bitcoin', 'BTC', 0.02, 1000, 1);
        $this->assertEquals($expectedCoin->getName(), $result->getName());
    }

    /**
     * @test
     */
    public function getCoinByIncorrectlyIdTest()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->APIClientMock->shouldReceive('getCoinDataWithId')
            ->once()
            ->with('50000')
            ->andThrow(new Exception("Coin Not found exception"));
        $APICoinDataSource = new APICoinDataSource($this->APIClientMock);
        $APICoinDataSource->getById('50000', 1000);
    }

    /**
     * @test
     */
    public function getBalanceByIdCorrectlyTest()
    {
        $coinData = [
            [
                'price_usd' => 1000
            ],
            [
                'price_usd' => 1000
            ]
        ];
        $this->APIClientMock->shouldReceive('getCoinDataWithId')
            ->once()
            ->with('80,90')
            ->andReturn($coinData);
        $APICoinDataSource = new APICoinDataSource($this->APIClientMock);
        $result = $APICoinDataSource->getBalanceById('80,90');
        $this->assertIsArray($result);
        $this->assertEquals(2, count($result));
    }

    /**
     * @test
     */
    public function getBalanceByIncorrectlyIdTest()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $this->APIClientMock->shouldReceive('getCoinDataWithId')
            ->once()
            ->with('50000,50000')
            ->andThrow(new Exception("Coin Not found exception"));
        $APICoinDataSource = new APICoinDataSource($this->APIClientMock);
        $APICoinDataSource->getById('50000,50000', 1000);
    }
}
