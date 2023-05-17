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
        $user_id = $request->input('user_id');

        $request->validate();
        $this->createWalletService->execute($user_id);
    }
}
