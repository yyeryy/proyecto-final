<?php

namespace App\Application;

use App\Domain\UserDataSource;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class WalletCryptocurrenciesService
{

    private CacheWalletDataSource $cacheWalletDataSource;

    public function __construct(CacheWalletDataSource $CacheWalletDataSource)
    {
        $this->cacheWalletDataSource = $CacheWalletDataSource;
    }
    public function execute(string $walletId)
    {
        return $this->cacheWalletDataSource->findById($walletId);
    }
}
