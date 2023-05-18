<?php

namespace App\Infrastructure\Persistence;

use App\Domain\CoinDataSource;
use PHPUnit\Util\Exception;

class APICoinDataSource implements CoinDataSource
{
    public function getById(string $coinId, float $amountUSD){
        try{

        }catch (Execption $e){
            throw new Exception("Coin Not found exception");
        }
    }
}
