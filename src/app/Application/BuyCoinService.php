<?php

namespace App\Application;


use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Database\Eloquent\Casts\Json;
use PHPUnit\Util\Exception;
use Symfony\Component\DependencyInjection\Exception\ExceptionInterface;

class BuyCoinService
{
    private CacheWalletDataSource $cacheWalletDataSource;
    private APICoinDataSource $apiCoinDataSource;

    public function __construct(CacheWalletDataSource $cacheWalletDataSource, APICoinDataSource $apiCoinDataSource)
    {
        $this->cacheWalletDataSource = $cacheWalletDataSource;
        $this->apiCoinDataSource = $apiCoinDataSource;
    }

    public function execute($datos)
    {
        $coinId = $datos['coin_id'];
        $walletId = $datos['wallet_id'];
        $amountUsd = $datos['amount_usd'];

        try{
            $this->cacheWalletDataSource->findById($walletId);
        } catch(Exception $e) {
            throw new Exception("Wallet Not found exception");
        }

        try{
            $this->apiCoinDataSource->getById($coinId);
        } catch(Exception $e) {
            throw new Exception("Coin Not found exception");
        }
    }
}
