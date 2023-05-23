<?php

namespace App\Application;


use App\Domain\UserDataSource;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\CacheUserDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class CreateWalletService
{
    private UserDataSource $userDataSource;
    private WalletDataSource $walletDataSource;

    public function __construct(UserDataSource $userDataSource, WalletDataSource $walletDataSource)
    {
        $this->userDataSource = $userDataSource;
        $this->walletDataSource = $walletDataSource;
    }
    public function execute(string $user_id)
    {
        //ESPECIAL 1 USUARIO
        //Comprobamos si el usuario es 1, el unico usuario valido

        //Si el usuario no existe no creamos cartera.
        if($this->userDataSource->findUserById($user_id) == null)
        {
            throw new Exception("User Not found exception");
        }
        //Si el usuario existe creamos cartera
        return $this->walletDataSource->createWallet($user_id);
    }
}
