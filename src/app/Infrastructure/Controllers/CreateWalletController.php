<?php

namespace App\Infrastructure\Controllers;

use App\Application\CreateWalletService;

class CreateWalletController
{
    public function __invoke(CreateWalletFormRequest $request)
    {
        return response()->json([
            'status' => 'Ok',
            ]);
        }
}
