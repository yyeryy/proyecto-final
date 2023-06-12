<?php

namespace App\Infrastructure\Controllers;

use App\Application\WalletCryptocurrenciesService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class WalletCryptocurrenciesController
{
    private WalletCryptocurrenciesService $walletService;

    public function __construct(WalletCryptocurrenciesService $walletService)
    {
        $this->walletService = $walletService;
    }
    public function __invoke(Request $request, $wallet_id)
    {
        if (!is_numeric($wallet_id)) {
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $wallet = $this->walletService->execute($wallet_id);
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
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
