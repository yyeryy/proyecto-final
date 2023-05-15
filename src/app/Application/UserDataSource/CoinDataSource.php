<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{

    /**
     * @return Coin[]
     */
    public function getAll(): array;
    //pruebas

    public function buyCoin(string $coin_id, string $wallet_id, float $amount_usd): int;

    public function sellCoin(string $coin_id): int;

}
