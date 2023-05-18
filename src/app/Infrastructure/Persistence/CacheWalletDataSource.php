<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
use Illuminate\Support\Facades\Cache;

class CacheWalletDataSource implements WalletDataSource
{

    public function getWallet_id(): string
    {
        // TODO: Implement getWallet_id() method.
    }

    public function getCoin(): Coin
    {
        // TODO: Implement getCoin() method.
    }

    public function setWallet_id($wallet_id)
    {
        // TODO: Implement setWallet_id() method.
    }

    public function setCoin($coin)
    {
        // TODO: Implement setCoin() method.
    }

    public function open(): int
    {
        // TODO: Implement open() method.
    }

    public function info(): int
    {
        // TODO: Implement info() method.
    }

    public function balance(): int
    {
        // TODO: Implement balance() method.
    }

    public function mostrarTop100Monedas(): int
    {
        // TODO: Implement mostrarTop100Monedas() method.
    }
    public function create(string $userid){
        $walletId = Cache::get('last_wallet_id', 0);
        $newId = $walletId + 1;

        $wallet = new Wallet($userid);
        Cache::put('wallet:' . $newId, array($wallet->getId(), $wallet->getCoin()));

        Cache::put('last_wallet_id', $newId);

        return $newId;
    }
}
