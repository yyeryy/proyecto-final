<?php

use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\IsEarlyAdopterUserController;
use App\Infrastructure\Controllers\GetStatusController;
use App\Infrastructure\Controllers\SellCoinController;
use App\Infrastructure\Controllers\WalletBalanceController;
use App\Infrastructure\Controllers\WalletCryptocurrenciesController;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Controllers\CreateWalletController;
use App\Infrastructure\Controllers\BuyCoinController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Comprobar estado de la API:
Route::get('/status', GetStatusController::class);

//Abrir cartera:
Route::post('/wallet/open', CreateWalletController::class);

//Comprar moneda:
Route::post('/coin/buy', BuyCoinController::class);

//Vender moneda:
Route::post('/coin/sell', SellCoinController::class);

//Obtener balance:
Route::get('/wallet/{wallet_id}/balance', WalletBalanceController::class);

//Obtener cryptomonedas:
Route::get('/wallet/{wallet_id}', WalletCryptocurrenciesController::class);

