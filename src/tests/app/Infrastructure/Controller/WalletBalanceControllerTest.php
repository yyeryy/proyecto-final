<?php

namespace Tests\app\Infrastructure\Controller;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use App\Application\WalletBalanceService;
use App\Infrastructure\Controllers\WalletBalanceController;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;


class WalletBalanceControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletBalanceController = Mockery::mock(WalletBalanceController::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function invalid_wallet_Id_test()
    {
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/h/balance', 'POST', [],[],[],[],$requestData);
        $this->WalletBalanceController->shouldReceive('__invoke')
            ->once()
            ->with($request, 'h')
            ->andReturn(new JsonResponse(['status' => 'ERROR: Los parametros introducidos no son validos.']));
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
        $request = Request::create('/wallet/1/balance', 'POST', [],[],[],[],$requestData);
        $this->WalletBalanceController->shouldReceive('__invoke')
            ->once()
            ->with($request, '1')
            ->andReturn(new JsonResponse(['Balance' => '500$']));
        $result = $this->WalletBalanceController->__invoke($request, '1');
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"Balance": "500$"}', $result->content());
    }

    /**
     * @test
     */
    public function invalid_wallet_Id_throw_exception_test()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Wallet Not found exception");
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/2/balance', 'POST', [],[],[],[],$requestData);
        $this->WalletBalanceController->shouldReceive('__invoke')
            ->once()
            ->with($request, '2')
            ->andThrow(new Exception("Wallet Not found exception"));
        $this->WalletBalanceController->__invoke($request, '2');
    }
}
