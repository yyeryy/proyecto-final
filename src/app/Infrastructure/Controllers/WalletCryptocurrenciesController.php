<?php

namespace App\Infrastructure\Controllers;

use App\Application\WalletCryptocurrenciesService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalletCryptocurrenciesController
{
    private WalletCryptocurrenciesService $walletCryptocurrenciesService;

    public function __construct(WalletCryptocurrenciesService $walletCryptocurrenciesService)
    {
        $this->walletCryptocurrenciesService = $walletCryptocurrenciesService;
    }
    public function __invoke(Request $request, $wallet_id)
    {
        if(!is_numeric($wallet_id)){
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ]);
        }

        try {
            $wallet = $this->walletCryptocurrenciesService->execute($wallet_id);
            $coins = $wallet->getCoin();
            $data = [];

            foreach ($coins as $coin) {
                $data[] = [
                    "coin_id" => $coin->getCoinId(),
                    "name" => $coin->getName(),
                    "symbol" => $coin->getSymbol(),
                    "amount" => $coin->getAmount(),
                    "value_usd" => $coin->getValueUsd()
                ];
            }
            return response()->json([
                "data" => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ]);
        }
    }
}
