<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\BuyCoinService;
use App\Infrastructure\Controllers\BuyCoinController;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;


class BuyCoinControllerTest extends TestCase
{
    /**
     * @test
     */
    public function do_correctly_buy_coin_test(){
        $this->buyCoinServiceMock = Mockery::mock(BuyCoinService::class);

        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);

        $this->buyCoinServiceMock->shouldReceive('execute')->once()->with(90, '1', 1000);

        $BuyCoinController = new BuyCoinController($this->buyCoinServiceMock);
        $result = $BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Compra realizada"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_amount_usd_less_than_zero_or_equal_test(){
        $this->buyCoinServiceMock = Mockery::mock(BuyCoinService::class);

        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);

        $BuyCoinController = new BuyCoinController($this->buyCoinServiceMock);
        $result = $BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El amount no puede ser menor o igual que 0"}', $result->content());
    }
}
