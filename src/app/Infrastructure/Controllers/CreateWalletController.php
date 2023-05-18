<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateWalletController
{
    private CreateWalletService $createWalletService;

    public function __construct()
    {
        $this->createWalletService = new CreateWalletService();
    }

    public function __invoke(Request $request)
    {
        //Validación de parámetros (CreateWalletFormRequest):
        $validator = Validator::make($request->all(),
        [
            "user_id" => "required|string",
        ]);
        if($validator->fails()){
            return response()->json([
                "status" => "ERROR: Los parametros introducidos no son validos."
            ]);
        }

        //Obtención de datos:
        $user_id = $request->input("user_id");

        //Ejecutar CreateWalletService:
        $wallet = $this->createWalletService->execute($user_id);

        //Error usuario no existe.
        if($wallet == null)
        {
            return response()->json([
                "status" => "ERROR: usuario no existe"
            ]);
        }

        //Devolver walletID.
        return response()->json([
            "walletID" => $wallet->getId()
        ]);
    }
}
