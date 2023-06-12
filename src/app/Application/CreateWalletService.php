<?php

namespace App\Application;

use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class CreateWalletService
{
    private CacheUserDataSource $cacheUserDataSource;
    private CacheWalletDataSource $cacheWallet;

    public function __construct(CacheUserDataSource $cacheUserDataSource, CacheWalletDataSource $cacheWallet)
    {
        $this->cacheUserDataSource = $cacheUserDataSource;
        $this->cacheWallet = $cacheWallet;
    }
    public function execute(string $user_id)
    {
        //ESPECIAL 1 USUARIO
        //Comprobamos si el usuario es 1, el unico usuario valido

        //Si el usuario no existe no creamos cartera.
        if ($this->cacheUserDataSource->findUserById($user_id) == null) {
            throw new Exception("User Not found exception");
        }
        //Si el usuario existe creamos cartera
        return $this->cacheWallet->createWallet($user_id);
    }
}
