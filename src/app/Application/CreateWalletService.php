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
        if($this->cacheUserDataSource->findUserById($user_id) == null)
        {
            $wallet = $this->cacheWalletDataSource->create($user_id);
            return $wallet;
        }
        return null;
    }
}
