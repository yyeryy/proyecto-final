<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CreateWalletController
{
    private CreateWalletService $createWalletService;

    public function __construct()
    {
        $this->createWalletService = new CreateWalletService(new CacheUserDataSource(), new CacheWalletDataSource());
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            "user_id" => "required|string",
        ]);
        if($validator->fails()){
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ], Response::HTTP_BAD_REQUEST);
        }

        $user_id = $request->input("user_id");
        $wallet = $this->createWalletService->execute($user_id);

        if($wallet == null)
        {
            return response()->json([
                "status" => "ERROR: usuario no existe"
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            "walletID" => $wallet->getId()
        ], Response::HTTP_OK);
    }
}
