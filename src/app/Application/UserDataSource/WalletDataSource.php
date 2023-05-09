<?php

namespace App\Application\WalletDataSource;

use App\Domain\Wallet;

Interface WalletDataSource
{

    /**
     * @return Wallet[]
     */
    public function getAll(): array;

    public function openWallet(string $user_id): string;

    public function getsWalletCryptocurrencies(string $wallet_id): array;

    public function getsWalletBalance(string $wallet_id): float;
}
