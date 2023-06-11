<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\WalletBalanceService;
use App\Infrastructure\Controllers\WalletBalanceController;
use Exception;
use Mockery;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WalletBalanceControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletBalanceServiceMock = Mockery::mock(WalletBalanceService::class);
        $this->WalletBalanceController = new WalletBalanceController($this->WalletBalanceServiceMock);
    }

    /**
     * @test
     */
    public function invalid_wallet_Id_test()
    {
        $requestData = json_encode(array('wallet_id' => 'h'));
        $request = Request::create('/wallet/h/balance', 'GET', [],[],[],[],$requestData);

        $result = $this->WalletBalanceController->__invoke($request, 'h');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "ERROR: Los parametros introducidos no son validos."}', $result->content());
    }

    /**
     * @test
     */
    public function get_correctly_balance_test()
    {
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/1/balance', 'GET', [],[],[],[],$requestData);
        $this->WalletBalanceServiceMock->shouldReceive('execute')
            ->once()
            ->with('1')
            ->andReturn('500$');

        $result = $this->WalletBalanceController->__invoke($request, '1');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"Balance": "500$"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_wallet_Id_throw_exception_test()
    {
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/2/balance', 'GET', [],[],[],[],$requestData);
        $this->WalletBalanceServiceMock->shouldReceive('execute')
            ->once()
            ->with('2')
            ->andThrow(new Exception("Wallet not found exception"));

        $result = $this->WalletBalanceController->__invoke($request, '2');

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Wallet not found exception"}', $result->content());
    }
}
