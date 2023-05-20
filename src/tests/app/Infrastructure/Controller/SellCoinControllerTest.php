<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\SellCoinService;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Validator;

class SellCoinControllerTest extends TestCase
{
    /**
     * @test
     */
    public function validate_request_returns_error_if_amount_usd_is_smaller_than_cero()
    {
        $sellCoinService = new SellCoinService(new CacheWalletDataSource(), new APICoinDataSource());
        $sellCoinController = new SellCoinController($sellCoinService);

        //$result = $sellCoinController->checkAmountUsdIsNotSmallerOrEqualThanCero(-1);
        $requestData = [
            'coin_id' => '90',
            'wallet_id' => '1',
            'amount_usd' => -1,
        ];

        // Crear una instancia de Request con los datos de prueba
        $request = Request::create('/coin/sell', 'POST', $requestData);

        $response = ($sellCoinController)->__invoke($request);

        //$result->assertExactJson(['errors' => 'El amount no puede ser menor o igual a 0']);
    }
}
