<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\Request;

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
        $wallet_id = $request->input("coin_id");
        $amount_usd = $request->input("coin_id");


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
}
