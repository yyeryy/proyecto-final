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

    public function execute($coinId, $walletId, $amountUsd)
    {
        try{
            $this->cacheWalletDataSource->findUserById($walletId);
        } catch(Exception $e) {
            throw new Exception("Wallet Not found exception");
        }

        try{
            $this->apiCoinDataSource->getById($coinId, $amountUsd);
        } catch(Exception $e) {
            throw new Exception("Coin Not found exception");
        }
    }
}
