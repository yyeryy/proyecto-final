<?php

namespace App\Application;


use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

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
        //Si el usuario no existe no creamos cartera.
        if($this->cacheUserDataSource->findUserById($user_id) == null)
        {
            throw new Exception("User Not found exception");
        }
        //Si el usuario existe creamos cartera
        return $this->cacheWalletDataSource->createWallet($user_id);
    }
}
