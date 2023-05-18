<?php

namespace App\Domain;

use App\Domain\UserDataSource\private;
use SebastianBergmann\Type\VoidType;

Interface UserDataSource
{
    // Atributos
    /**
     * @var private string user_id; Indentificador del usuario.
     * @var private Wallet wallet; Cartera del usuario.
     */

    //Obtenemos el unico user de la cache:
    public function getUserFromCache(): User;

    // Funciones
    public function findUserById(string $userId);
}
