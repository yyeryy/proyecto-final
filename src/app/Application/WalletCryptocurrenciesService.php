<?php

namespace App\Application;

use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class WalletCryptocurrenciesService
{
    private CacheWalletDataSource $cacheWallet;

    public function __construct(CacheWalletDataSource $CacheWallet)
    {
        $this->cacheWallet = $CacheWallet;
    }
    public function execute(string $walletId)
    {
        return $this->cacheWallet->findById($walletId);
    }
}
