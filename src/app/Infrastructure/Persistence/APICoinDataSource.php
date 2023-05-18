<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Coin;
use App\Domain\CoinDataSource;
use PHPUnit\Util\Exception;

class APICoinDataSource implements CoinDataSource
{
    private APIClient $APIClient;
    public function getById(string $coinId, float $amountUSD){
        try{
            $this->APIClient = new APIClient();
            $datos = $this->APIClient->getCoinDataWithId($coinId);
            return new Coin($datos[0]['id'], $datos[0]['name'], $datos[0]['symbol'], $amountUSD/$datos[0]['price_usd'], $datos[0]['price_usd']);
        }catch (Exception $e){
            throw new Exception("Coin Not found exception");
        }
    }
}
