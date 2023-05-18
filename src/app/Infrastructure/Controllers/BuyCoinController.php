<?php

namespace App\Infrastructure\Controllers;

use App\Application\BuyCoinService;
use http\Env\Request;
use Illuminate\Support\Facades\Validator;

class BuyCoinController
{

    private BuyCoinService $buyCoinService;

    public function __construct(BuyCoinService $buyCoinService)
    {
        $this->buyCoinService = $buyCoinService;
    }
    public function __invoke(BuyCoinFormRequest $request)
    {
        /*$validator = Validator::make($request->all(), [
            'coin_id' => 'required|string',
            'wallet_id' => 'required|string',
            'amount_usd' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        return response()->json(['message' => 'Compra de moneda exitosa'], 200);*/

        $validatedData = $request->validated();

        try {
            $this->buyCoinService->execute($validatedData);
        } catch (Exception $e) {
            return response()->json([
                "status" => $e->getMessage()
            ]);
        }
    }
}
