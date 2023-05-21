<?php

namespace Tests\app\Infrastructure\Controller;

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
    /**

    @test*/
    public function test_wallet_balance_controller()
    {
        $walletBalanceService = new WalletBalanceService(new CacheWalletDataSource(), new APICoinDataSource());
        $walletBalanceController = new WalletBalanceController($walletBalanceService);

        $data = array('wallet_id' => '1');
        $requestData = json_encode($data);

        $request = Request::create('/coin/sell', 'POST', [],[],[],[],$requestData);

        $response = ($walletBalanceController)->__invoke($request, 'hola');

        $this->assertExactJson(['status' => 'ERROR: Los parametros introducidos no son validos.']);
        //$this->assertEquals('Hola', $response);
    }
}
