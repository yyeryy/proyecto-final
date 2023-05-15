<?php

namespace App\Application\UserDataSource;

use App\Domain\User;
use App\Domain\Wallet;

Interface UserDataSource
{
    // Atributos
    /**
     * @var private string user_id; Indentificador del usuario.
     * @var private Wallet wallet; Cartera del usuario.
     */

    // Getters
    public function getUser_id();
    public function getWallet();

    // Setters
    public function setUser_id(string $user_id);
    public function setWallet(Wallet $wallet);
}
