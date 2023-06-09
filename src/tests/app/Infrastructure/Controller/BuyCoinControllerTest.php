<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\BuyCoinService;
use App\Infrastructure\Controllers\BuyCoinController;
use App\Infrastructure\Persistence\APIClient;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
//use PHPUnit\Framework\TestCase;
use PHP_CodeSniffer\Util\Cache;
use Tests\TestCase;


class BuyCoinControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->buyCoinServiceMock = Mockery::mock(BuyCoinService::class);
    }

    /**
     * @test
     */
    public function do_correctly_buy_coin_test(){
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

    /**
     * @test
     */
    public function invalid_coin_test(){
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

    /**
     * @test
     */
    public function invalid_wallet_test(){
        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '2',
            'amount_usd' => 100
        ]);

        $BuyCoinController = new BuyCoinController($this->buyCoinServiceMock);
        $result = $BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El id de la wallet es invalido"}', $result->content());
    }
}
