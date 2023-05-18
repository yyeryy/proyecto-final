<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;

class CreateWalletController
{
    public function __construct(CreateWalletService $createWalletService)
    {
        $this->createWalletService = $createWalletService;
    }
    public function __invoke(CreateWalletFormRequest $request)
    {
        $user_id = $request->safe()->only(['user_id']);
        $this->createWalletService->execute($user_id);
        return response()->json([
            'status' => 'Ok',
        ]);
    }
}
