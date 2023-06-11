<?php

namespace App\Domain;

use App\Domain\WalletDataSource\private;

Interface WalletDataSource
{
    public function createWallet(string $userid);
    public function findById(string $walletId);
}
