<?php

namespace App\Application;


use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class CreateWalletService
{
    private CacheUserDataSource $cacheUserDataSource;
    private CacheWalletDataSource $cacheWalletDataSource;

    public function __construct(CacheUserDataSource $cacheUserDataSource, CacheWalletDataSource $cacheWalletDataSource)
    {
        $this->cacheUserDataSource = $cacheUserDataSource;
        $this->cacheWalletDataSource = $cacheWalletDataSource;
    }
    public function execute(string $user_id)
    {
        $wallet = $this->cacheUserDataSource->findUserById($user_id);
        return $wallet;
    }
}
