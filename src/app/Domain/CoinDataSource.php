<?php

namespace App\Domain;

use App\Domain\CoinDataSource\private;

Interface CoinDataSource
{
    public function getById(string $coinId, float $amountUSD);

    public function getBalanceById(string $coins);
}
