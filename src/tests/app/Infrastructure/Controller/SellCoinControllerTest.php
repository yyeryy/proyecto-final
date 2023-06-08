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
    protected function setUp(): void
    {
        parent::setUp();
        $this->sellCoinServiceMock = Mockery::mock(SellCoinService::class);
    }

    /**
     * @test
     */
    public function do_correctly_buy_coin_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);
        $this->sellCoinServiceMock->shouldReceive('execute')->once()->with(90, '1', 1000);

        $SellCoinController = new SellCoinController($this->sellCoinServiceMock);
        $result = $SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Venta realizada"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_amount_usd_less_than_zero_or_equal_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);

        $SellCoinController = new SellCoinController($this->sellCoinServiceMock);
        $result = $SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El amount no puede ser menor o igual a 0"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_coin_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);

        $SellCoinController = new SellCoinController($this->sellCoinServiceMock);
        $result = $SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El amount no puede ser menor o igual a 0"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_wallet_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '2',
            'amount_usd' => 100
        ]);

        $SellCoinController = new SellCoinController($this->sellCoinServiceMock);
        $result = $SellCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El id de la wallet es invalido"}', $result->content());
    }
}
