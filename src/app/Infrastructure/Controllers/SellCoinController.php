<?php

namespace App\Infrastructure\Controllers;

use App\Application\SellCoinService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellCoinController
{
    private SellCoinService $sellCoinService;

    public function __construct(SellCoinService $sellCoinService)
    {
        $this->sellCoinService = $sellCoinService;
    }
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coin_id' => 'required|string',
            'wallet_id' => 'required|string',
            'amount_usd' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user_id = $request->input("coin_id");
        $wallet_id = $request->input("wallet_id");
        $amount_usd = $request->input("amount_usd");

        //$this->checkAmountUsdIsNotSmallerOrEqualThanCero($amount_usd);
        if($amount_usd <= 0){
            return response()->json([
                "errors" => "El amount no puede ser menor o igual a 0"
            ]);
        }

        try {
            $this->sellCoinService->execute($user_id, $wallet_id, $amount_usd);
            return response()->json([
                "status" => "Venta realizada"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ]);
        }
    }

    /*
    public function checkAmountUsdIsNotSmallerOrEqualThanCero(int $amount_usd)
    {
        if($amount_usd <= 0){
            return response()->json([
                "errors" => "El amount no puede ser menor o igual a 0"
            ]);
        }
    }
    */
}
