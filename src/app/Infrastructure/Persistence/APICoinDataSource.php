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
            return new Coin($datos[0]['id'], $datos[0]['name'], $datos[0]['symbol'], $amountUSD/$datos[0]['price_usd'], $amountUSD, $datos[0]['rank']);
        }catch (Exception $e){
            throw new Exception("Coin Not found exception");
        }
    }

    public function getBalanceById(string $coins){
        try{
            $this->APIClient = new APIClient();
            $datos = $this->APIClient->getCoinDataWithId($coins);
            $price_array = [];
            foreach ($datos as $dato){
                array_push($price_array, $dato['price_usd']);
            }
            return $price_array;
        }catch (Exception $e){
            throw new Exception("Coin Not found exception");
        }
    }
}
