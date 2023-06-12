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

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
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
    public function invalidWalletIdTest()
    {
        $request = Request::create('/wallet/open', 'POST', [
            'user_id' => '2'
        ]);
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('2')->andReturn(null);

        $result = $this->CreateWalletController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "ERROR: usuario no existe"}', $result->content());
    }

    /**
     * @test
     */
    public function getWalletIdTest()
    {
        $wallet = new Wallet('1');
        $request = Request::create('/wallet/open', 'POST', [
            'user_id' => '1'
        ]);
        $this->CreateWalletServiceMock->shouldReceive('execute')->once()->with('1')->andReturn($wallet);

        $result = $this->CreateWalletController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"walletID": "1"}', $result->content());
    }
}
