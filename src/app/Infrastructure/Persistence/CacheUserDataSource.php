<?php

namespace App\Infrastructure\Persistence;
use App\Domain\UserDataSource;
use App\Domain\Wallet;
use PhpParser\Node\Scalar\String_;

class CacheUserDataSource implements UserDataSource
{

    public function getUser_id()
    {
        // TODO: Implement getUser_id() method.
    }

    public function getWallet()
    {
        // TODO: Implement getWallet() method.
    }

    public function setUser_id(string $user_id)
    {
        // TODO: Implement setUser_id() method.
    }

    public function setWallet(Wallet $wallet)
    {
        // TODO: Implement setWallet() method.
    }

    public function findUserById(string $userId): string
    {
        return cogerUserCache($userId);
    }
}
