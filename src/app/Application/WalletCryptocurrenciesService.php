<?php

namespace App\Application;

use App\Domain\UserDataSource;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class WalletCryptocurrenciesService
{
    private UserDataSource $userDataSource;
    private WalletDataSource $walletDataSource;

    public function __construct(UserDataSource $userDataSource, WalletDataSource $walletDataSource)
    {
        $this->userDataSource = $userDataSource;
        $this->walletDataSource = $walletDataSource;
    }
    public function execute(string $walletId)
    {
        return $this->walletDataSource->findById($walletId);
    }
}
