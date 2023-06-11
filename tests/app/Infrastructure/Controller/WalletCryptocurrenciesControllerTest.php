<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\WalletCryptocurrenciesService;
use App\Domain\Coin;
use App\Domain\Wallet;
use App\Infrastructure\Controllers\WalletCryptocurrenciesController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Exception;
use Mockery;

class WalletCryptocurrenciesControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletCryptocurrenciesServiceMock = Mockery::mock(WalletCryptocurrenciesService::class);
        $this->WalletCryptocurrenciesController = new WalletCryptocurrenciesController($this->WalletCryptocurrenciesServiceMock);
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
        $requestData = json_encode(array('wallet_id' => 'h'));
        $request = Request::create('/wallet/h', 'GET', [],[],[],[],$requestData);

        $result = $this->WalletCryptocurrenciesController->__invoke($request, 'h');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "ERROR: Los parametros introducidos no son validos."}', $result->content());
    }

    /**
     * @test
     */
    public function get_correctly_cryptocurrencies_test()
    {
        $wallet = new Wallet('1');
        $coin = new Coin(90, 'Bitcoin', 'BTC', 1, 27000, 1);
        $wallet->insertCoin($coin);
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/1', 'GET', [],[],[],[],$requestData);
        $this->WalletCryptocurrenciesServiceMock->shouldReceive('execute')
            ->once()
            ->with('1')
            ->andReturn($wallet);

        $result = $this->WalletCryptocurrenciesController->__invoke($request, '1');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"data":[{"coin_id":90,"name":"Bitcoin","symbol":"BTC","amount":1,"value_usd":27000}]}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_wallet_id_throw_exception_test()
    {
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/2', 'GET', [],[],[],[],$requestData);
        $this->WalletCryptocurrenciesServiceMock->shouldReceive('execute')
            ->once()
            ->with('2')
            ->andThrow(new Exception("Wallet Not found exception"));

        $result = $this->WalletCryptocurrenciesController->__invoke($request, '2');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Wallet Not found exception"}', $result->content());
    }
}
