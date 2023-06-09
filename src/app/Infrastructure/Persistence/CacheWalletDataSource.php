<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use PHPUnit\Util\Exception;

class CacheWalletDataSource implements WalletDataSource
{
    protected $cache;

    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    public function createWallet(string $userid)
    {
        //$wallet = Cache::get('wallet:' . $userid);
        $wallet = $this->cache->get('wallet:' . $userid);
        if (!$wallet) {
            $wallet = new Wallet($userid);
            //Cache::put('wallet:' . $userid, $wallet);
            $this->cache->put('wallet:' . $userid, $wallet);
            return $wallet;
        }
        return $wallet;
    }

    public function findById(string $walletId)
    {
        //$wallet = Cache::get('wallet:' . $walletId);
        $wallet = $this->cache->get('wallet:' . $walletId);
        if ($wallet) {
            return $wallet;
        }
        throw new Exception("Wallet Not found exception");
    }
}
