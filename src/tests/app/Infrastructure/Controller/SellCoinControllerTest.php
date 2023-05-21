<?php

namespace Tests\Infrastructure\Controllers;

use App\Application\SellCoinService;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use Illuminate\Http\Request;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellCoinControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testValidationFailsWithInvalidData()
    {
        // Configurar las dependencias necesarias
        $apiCoinDataSource = $this->getMockBuilder(APICoinDataSource::class)->getMock();
        $cacheWalletDataSource = $this->getMockBuilder(CacheWalletDataSource::class)->getMock();
        $sellCoinService = new SellCoinService($cacheWalletDataSource, $apiCoinDataSource);

        // Crear una instancia del controlador
        $controller = new SellCoinController($sellCoinService);

        // Crear una solicitud falsa con datos de prueba inválidos
        $request = Request::create('/api/sell-coin', 'POST', [
            'coin_id' => '',
            'wallet_id' => '123',
            'amount_usd' => 'abc',
        ]);

        // Ejecutar la función __invoke() del controlador
        $response = $controller->__invoke($request);

        // Verificar el estado de respuesta y los errores de validación
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['coin_id']);
    }

    /*public function validate_request_returns_error_if_amount_usd_is_smaller_than_cero()
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
    }*/
}
