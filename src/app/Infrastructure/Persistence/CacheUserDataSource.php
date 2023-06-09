<?php

namespace App\Infrastructure\Persistence;

use App\Domain\User;
use App\Domain\UserDataSource;
use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Util\Exception;

define("UNIQUE_USER_ID", "1");

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
class CacheUserDataSource implements UserDataSource
{
    //Obtenemos usuario de caché.
    public function getUserFromCache(): User
    {
        // Comprobar si el usuario es 1, único usuario válido.

        $user = Cache::get('user:' . UNIQUE_USER_ID);
        if (!$user) {
            throw new Exception("User Not found exception");
        }
        return $user;
    }

    public function findUserById(string $userId)
    {
        $user = Cache::get('user:' . $userId);
        if ($userId == "1") {
            if ($user) {
                return $user;
            } else {
                Cache::put('user:' . $userId, $userId);
                $user = Cache::get('user:' . $userId);
                return $user;
            }
        }
        return null;
    }
}
