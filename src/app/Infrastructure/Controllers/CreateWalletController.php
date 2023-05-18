<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;

class CreateWalletController
{
    protected $createWalletService;

    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService = $createWalletService;
    }
    public function __invoke(CreateWalletFormRequest $request)
    {

        $request->validate();

        $validatedData = $request->validated();

        $user_id = $validatedData['user_id'];

        $this->createWalletService->execute($user_id);
        return response()->json(['message' => 'Validación exitosa', 'data' => $validatedData]);
    }
}
