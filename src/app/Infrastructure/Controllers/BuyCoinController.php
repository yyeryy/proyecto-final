<?php

namespace App\Infrastructure\Controllers;

use App\Application\BuyCoinService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuyCoinController
{

    private BuyCoinService $buyCoinService;

    public function __construct(BuyCoinService $buyCoinService)
    {
        $this->buyCoinService = $buyCoinService;
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


        try {
            $this->buyCoinService->execute($user_id, $wallet_id, $amount_usd);
            return response()->json([
                "status" => "Compra realizada"
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ]);
        }
    }
}
