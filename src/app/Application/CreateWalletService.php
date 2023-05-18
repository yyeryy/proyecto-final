<?php

namespace App\Application;


use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class CreateWalletService
{
    private CacheUserDataSource $cacheUserDataSource;
    private CacheWalletDataSource $cacheWalletDataSource;

    public function __construct()
    {
        $this->cacheUserDataSource = new cacheUserDataSource();
        $this->cacheWalletDataSource = new cacheWalletDataSource();
    }
    public function execute(string $user_id)
    {
        //ESPECIAL 1 USUARIO
        //Comprobamos si el usuario es 1, el unico usuario valido
        if($user_id=="1"){
            return $this->cacheWalletDataSource->createWallet($user_id);
        }
        //FIN ESPECIAL

        //Si el usuario no existe no creamos cartera.
        if($this->cacheUserDataSource->findUserById($user_id) == null)
        {

            return null;
        }

        //Si el usuario existe creamos cartera
        return $this->cacheWalletDataSource->createWallet($user_id);
    }
}
