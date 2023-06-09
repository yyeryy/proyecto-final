<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\CreateWalletService;
use App\Domain\Wallet;
use App\Infrastructure\Controllers\CreateWalletController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tests\TestCase;
use Exception;
use Mockery;

class CreateWalletControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->CreateWalletServiceMock = Mockery::mock(CreateWalletService::class);
        $this->CreateWalletController = new CreateWalletController($this->CreateWalletServiceMock);
    }

    /**
     * @test
     */
    public function invalid_wallet_id_test()
    {
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/open', 'POST', [],[],[],[],$requestData);
        $this->CreateWalletServiceMock->shouldReceive('__invoke')
            ->once()
            ->with($request, '2')
            ->andReturn(new JsonResponse(['status' => 'ERROR: usuario no existe']));

        $result = $this->CreateWalletController->__invoke($request, '2');
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "ERROR: usuario no existe"}', $result->content());
    }
    /**
     * @test
     */
    public function get_wallet_id_test()
    {
        $wallet = new Wallet('1');
        $requestData = json_encode(array('user_id' => '1'));
        $request = Request::create('/wallet/open', 'POST', [],[],[],[],$requestData);
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn($wallet);
        $result = $this->CreateWalletController->__invoke($request);
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"walletID": "1"}', $result->content());
    }
}
