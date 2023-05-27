<?php

namespace App\Infrastructure\Controllers;

use App\Application\WalletBalanceService;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class WalletBalanceController
{
    private WalletBalanceService $walletBalanceService;

    public function __construct(WalletBalanceService $walletBalanceService)
    {
        $this->walletBalanceService = $walletBalanceService;
    }
    public function __invoke(Request $request, $wallet_id)
    {
        if(!is_numeric($wallet_id)){
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ]);
        }

        try {
            $balance = $this->walletBalanceService->execute($wallet_id);
            return response()->json([
                "Balance" => $balance
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ]);
        }
    }
}
