<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\BuyCoinService;
use App\Infrastructure\Controllers\BuyCoinController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery;
use Exception;
use Tests\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class BuyCoinControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->buyCoinServiceMock = Mockery::mock(BuyCoinService::class);
        $this->BuyCoinController = new BuyCoinController($this->buyCoinServiceMock);
    }

    /**
     * @test
     */
    public function doCorrectlyBuyCoinTest()
    {
        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => 1000
        ]);
        $this->buyCoinServiceMock->shouldReceive('execute')->once()->with(90, '1', 1000);

        $result = $this->BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"status": "Compra realizada"}', $result->content());
    }

    /**
     * @test
     */
    public function invalidAmountUsdLessThanZeroOrEqualTest()
    {
        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -100
        ]);

        $result = $this->BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString(
            '{"errors": "El amount no puede ser menor o igual que 0"}',
            $result->content()
        );
    }

    /**
     * @test
     */
    public function invalidCoinThrowExceptionTest()
    {
        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '50000',
            'wallet_id' => '1',
            'amount_usd' => 100
        ]);
        $this->buyCoinServiceMock->shouldReceive('execute')
            ->once()
            ->with('50000', '1', 100)
            ->andThrow(new Exception("Coin not found exception"));

        $result = $this->BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "Coin not found exception"}', $result->content());
    }

    /**
     * @test
     */
    public function invalidWalletIdThrowExceptionTest()
    {
        $request = Request::create('/coin/buy', 'POST', [
            'coin_id' => '90',
            'wallet_id' => '2',
            'amount_usd' => 100
        ]);
        $this->buyCoinServiceMock->shouldReceive('execute')
            ->once()
            ->with('90', '2', 100)
            ->andThrow(new Exception("Wallet not found exception"));

        $result = $this->BuyCoinController->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $result);
        $this->assertJsonStringEqualsJsonString('{"errors": "Wallet not found exception"}', $result->content());
    }
}
