<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\SellCoinService;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Persistence\APIClient;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellCoinControllerTest extends TestCase
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->sellCoinServiceMock = Mockery::mock(SellCoinService::class);
        $this->SellCoinController = new SellCoinController($this->sellCoinServiceMock);
    }

    /**
     * @test
     */
    public function doCorrectlyBuyCoinTest()
    {
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);
        $this->sellCoinServiceMock->shouldReceive('execute')->once()->with(90, '1', 1000);

        $result = $this->SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Venta realizada"}', $result->content());
    }

    /**
     * @test
     */
    public function invalidAmountUsdLessThanZeroOrEqualTest()
    {
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);

        $result = $this->SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString(
            '{"errors": "El amount no puede ser menor o igual a 0"}',
            $result->content()
        );
    }

    /**
     * @test
     */
    public function invalidCoinThrowExceptionTest()
    {
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '50000',
            'wallet_id' => '1',
            'amount_usd' => 100
        ]);
        $this->sellCoinServiceMock->shouldReceive('execute')
            ->once()
            ->with('50000', '1', 100)
            ->andThrow(new Exception("Coin not found exception"));

        $result = $this->SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString(
            '{"status": "Coin not found exception"}',
            $result->content()
        );
    }

    /**
     * @test
     */
    public function invalidWalletIdThrowExceptionTest()
    {
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '2',
            'amount_usd' => 100
        ]);
        $this->sellCoinServiceMock->shouldReceive('execute')
            ->once()
            ->with('90', '2', 100)
            ->andThrow(new Exception("Wallet not found exception"));

        $result = $this->SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString(
            '{"status": "Wallet not found exception"}',
            $result->content()
        );
    }
}
