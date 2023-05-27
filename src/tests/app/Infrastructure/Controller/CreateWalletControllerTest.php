<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\CreateWalletController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Exception;
use Mockery;

class CreateWalletControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->CreateWalletController = Mockery::mock(CreateWalletController::class);
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
        $requestData = json_encode(array('wallet_id' => '2'));
        $request = Request::create('/wallet/open', 'POST', [],[],[],[],$requestData);
        $this->CreateWalletController->shouldReceive('__invoke')
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
        $requestData = json_encode(array('wallet_id' => '1'));
        $request = Request::create('/wallet/open', 'POST', [],[],[],[],$requestData);
        $this->CreateWalletController->shouldReceive('__invoke')
            ->once()
            ->with($request, '1')
            ->andReturn(new JsonResponse(['status' => '1']));
        $result = $this->CreateWalletController->__invoke($request, '1');
        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "1"}', $result->content());
    }
}
