<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Support\Facades\Cache;
use App\Domain\User;
use App\Domain\Wallet;

class CacheServiceProvider
{
    public function anadirUserCache() {
        $userId = Cache::get('last_user_id', 0);
        $newId = $userId + 1;

        $user = new User($newId, new Wallet($newId));
        Cache::put('user:' . $newId, $user);

        Cache::put('last_user_id', $newId);

        return $newId;
    }

    public function cogerUserCache($id){
        $user = Cache::get('user:' . $id);
        if ($user) {
            $userId = $user->getId();
            $wallet = $user->getWallet();

            return array($userId, $wallet);
        }
        return null;
    }
}
