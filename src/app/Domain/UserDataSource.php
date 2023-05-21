<?php

namespace App\Domain;

use App\Domain\UserDataSource\private;
use SebastianBergmann\Type\VoidType;

Interface UserDataSource
{
    /**
     * @var private string user_id; Indentificador del usuario.
     * @var private Wallet wallet; Cartera del usuario.
     */
    public function getUserFromCache(): User;
    public function findUserById(string $userId);
}
