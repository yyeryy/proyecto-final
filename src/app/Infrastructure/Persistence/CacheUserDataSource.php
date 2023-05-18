<?php

namespace App\Infrastructure\Persistence;
use App\Domain\User;
use App\Domain\UserDataSource;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;

define("UNIQUE_USER_ID", "1");

class CacheUserDataSource implements UserDataSource
{
    public function getUserFromCache(): User
    {
        $user = Cache::get('user:' . UNIQUE_USER_ID);
        if(!$user)
        {
            return $user;
        }
        return $user;
    }

    public function getUser_id(): string
    {
        // TODO: Implement getUser_id() method.
        return "1";
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
