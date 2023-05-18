<?php

namespace App\Infrastructure\Controllers;

use http\Env\Request;
use Illuminate\Support\Facades\Validator;

class BuyCoinController
{
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

        return response()->json(['message' => 'Compra de moneda exitosa'], 200);
    }
}
