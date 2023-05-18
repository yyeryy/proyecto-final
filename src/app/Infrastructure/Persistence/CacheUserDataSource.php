<?php

namespace App\Infrastructure\Persistence;
use App\Domain\UserDataSource;
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheServiceProvider;

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

    public function findUserById(string $userId)
    {
        $user = Cache::get('user:' . $userId);
        if ($user) {
            return array($user[0], $user[1]);
        }
        return null;
    }
}
