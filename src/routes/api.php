<?php

use App\Infrastructure\Controllers\GetUserController;
use App\Infrastructure\Controllers\IsEarlyAdopterUserController;
use App\Infrastructure\Controllers\GetStatusController;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Controllers\CreateWalletFormRequest;

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

//Venia desde el principio.
Route::get('/status', GetStatusController::class);

Route::get('/wallet/open', [CreateWalletFormRequest::class, 'handle']);


//CreateWallet
//Route::get('/wallet/open', Get)

Route::post('/coin/sell', function () {
    return redirect('localhost:8088/api/coin/sell');
});

Route::post('/coin/buy', function () {
    return redirect('localhost:8088/api/coin/buy');
});

Route::post('/wallet/open', function () {
    return redirect('localhost:8088/api/wallet/open');
});

Route::get('/wallet/{wallet_id}', function ($wallet_id) {
    return redirect('localhost:8088/api/wallet/' . $wallet_id);
});

Route::get('/wallet/{wallet_id}/balance', function ($wallet_id) {
    return redirect('localhost:8088/api/wallet/' . $wallet_id . '/balance');
});

