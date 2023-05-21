<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\SellCoinService;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellCoinControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->BuyCoinController = Mockery::mock(SellCoinController::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    use RefreshDatabase;

    /**
     * @test
     */
    public function invalid_amount_usd_less_than_zero_or_equal_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);
        $this->BuyCoinController->shouldReceive('__invoke')
            ->once()
            ->with($request)
            ->andReturn(new JsonResponse(["errors" => "El amount no puede ser menor o igual que 0"]));
        $result = $this->BuyCoinController->__invoke($request);
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "El amount no puede ser menor o igual que 0"}', $result->content());
    }

    /**
     * @test
     */
    public function do_correctly_sell_coin_test(){
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);
        $this->BuyCoinController->shouldReceive('__invoke')
            ->once()
            ->with($request)
            ->andReturn(new JsonResponse(["status" => "Venta realizada"]));
        $result = $this->BuyCoinController->__invoke($request);
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Venta realizada"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_coin_Id_throw_exception_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Coin Not found exception");
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '50000',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);
        $this->BuyCoinController->shouldReceive('__invoke')
            ->once()
            ->with($request)
            ->andThrow(new Exception("Coin Not found exception"));
        $this->BuyCoinController->__invoke($request);
    }

    /**
     * @test
     */
    public function invalid_wallet_Id_throw_exception_test(){
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Wallet Not found exception");
        $request = Request::create('/coin/sell', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '2',
            'amount_usd' => 1000
        ]);
        $this->BuyCoinController->shouldReceive('__invoke')
            ->once()
            ->with($request)
            ->andThrow(new Exception("Wallet Not found exception"));
        $this->BuyCoinController->__invoke($request);
    }
}
