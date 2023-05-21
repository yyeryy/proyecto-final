<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\WalletCryptocurrenciesController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Exception;
use Mockery;

class WalletCryptocurrenciesControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletCryptocurrenciesController = Mockery::mock(WalletCryptocurrenciesController::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function invalid_wallet_id_test()
    {
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/h', 'GET', [],[],[],[],$requestData);
        $this->WalletCryptocurrenciesController->shouldReceive('__invoke')
            ->once()
            ->with($request, 'h')
            ->andReturn(new JsonResponse(['status' => 'ERROR: Los parametros introducidos no son validos.']));
        $result = $this->WalletCryptocurrenciesController->__invoke($request, 'h');
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "ERROR: Los parametros introducidos no son validos."}', $result->content());
    }

    /**
     * @test
     */
    public function get_correctly_cryptocurrencies_test()
    {
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/1', 'GET', [],[],[],[],$requestData);
        $this->WalletCryptocurrenciesController->shouldReceive('__invoke')
            ->once()
            ->with($request, '1')
            ->andReturn(new JsonResponse(['coin_id' => '90', 'name' => 'Bitcoin', 'symbol' => 'BTC', 'amount' => '1', 'value_usd' => '27000']));
        $result = $this->WalletCryptocurrenciesController->__invoke($request, '1');
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"coin_id": "90", "name": "Bitcoin", "symbol": "BTC", "amount": "1", "value_usd": "27000"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_wallet_id_throw_exception_test()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Wallet Not found exception");
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/2', 'GET', [],[],[],[],$requestData);
        $this->WalletCryptocurrenciesController->shouldReceive('__invoke')
            ->once()
            ->with($request, '2')
            ->andThrow(new Exception("Wallet Not found exception"));
        $this->WalletCryptocurrenciesController->__invoke($request, '2');
    }
}
