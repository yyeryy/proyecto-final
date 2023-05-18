<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Util\Exception;

class CacheWalletDataSource implements WalletDataSource
{
    public function createWallet(string $userid){
        $wallet = Cache::get('wallet:' . $userid);
        if(!$wallet) {
            $wallet = new Wallet($userid);
            Cache::put('wallet:' . $userid, $wallet);
            return $wallet;
        }
        return $wallet;
    }

    public function findUserById(string $walletId)
    {
        $wallet = Cache::get('wallet:' . $walletId);
        if ($wallet) {
            return $wallet;
        }
        throw new Exception("Coin Not found exception");
    }
}
