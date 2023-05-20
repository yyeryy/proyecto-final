<?php

namespace Tests\Infrastructure\Controllers;

use App\Infrastructure\Controllers\BuyCoinController;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;

class BuyCoinControllerTest extends TestCase
{
    /**
     * @test
     */
    /*
    public function validacion_parametros_pasados_en_consulta_test(){
        $requestData = [
            'coin_id' => 'BTC',
            'wallet_id' => '1',
            'amount_usd' => 100,
        ];
        $request = Request::create('/coin/buy', 'POST', $requestData);

        // Ejecutar la función __invoke()
        $response = (new BuyCoinController())->__invoke($request);

        // Verificar el código de estado de la respuesta
        $response->assertStatus(200);
    }*/
}
