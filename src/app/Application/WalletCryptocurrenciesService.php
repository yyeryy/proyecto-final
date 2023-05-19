<?php

namespace App\Application;

use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class WalletCryptocurrenciesService
{
    private CacheUserDataSource $cacheUserDataSource;
    private CacheWalletDataSource $cacheWalletDataSource;

    public function __construct()
    {
        $this->cacheUserDataSource = new cacheUserDataSource();
        $this->cacheWalletDataSource = new cacheWalletDataSource();
    }
    public function execute(string $walletId)
    {
        return $this->cacheWalletDataSource->findById($walletId);
    }
}
