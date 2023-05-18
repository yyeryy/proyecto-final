<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;

class CreateWalletController
{
    private CreateWalletService $createWalletService;

    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService = $createWalletService;
    }
    public function __invoke(CreateWalletFormRequest $request)
    {
        $validatedData = $request->validated();

        $user_id = $validatedData['user_id'];

        $wallet = $this->createWalletService->execute($user_id);
        if($wallet == null)
        {
            return reponse()->json([
                "status" => "Error usuario no existe"
            ]);
        }
        return response()->json([
            "walletID" => $wallet
        ]);
    }
}
