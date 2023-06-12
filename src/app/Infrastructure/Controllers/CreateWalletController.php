<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class CreateWalletController
{
    private CreateWalletService $createWalletService;

    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService = $createWalletService;
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), ["user_id" => "required|string"]);
        if ($validator->fails()) {
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ]);
        }

        $user_id = $request->input("user_id");
        $wallet = $this->createWalletService->execute($user_id);

        if ($wallet == null) {
            return response()->json([
                "status" => "ERROR: usuario no existe"
            ]);
        }

        return response()->json([
            "walletID" => $wallet->getId()
        ]);
    }
}
