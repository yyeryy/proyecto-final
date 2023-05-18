<?php

namespace App\Domain;

use App\Application\UserDataSource\private;

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

    // Funciones
    public function findUserById(string $userId);
}
