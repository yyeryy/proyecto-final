<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
use Illuminate\Support\Facades\Cache;

class CacheWalletDataSource implements WalletDataSource
{

    public function create(string $userid){
        $walletId = Cache::get('last_wallet_id', 0);
        $newId = $walletId + 1;

        $wallet = new Wallet($userid);
        Cache::put('wallet:' . $newId, array($wallet->getId(), $wallet->getCoin()));

        Cache::put('last_wallet_id', $newId);

        return $newId;
    }
}
