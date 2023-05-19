<?php

namespace App\Application;

use Illuminate\Support\Facades\Cache;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class SellCoinService
{
    private CacheWalletDataSource $cacheWalletDataSource;
    private APICoinDataSource $apiCoinDataSource;

    public function __construct(CacheWalletDataSource $cacheWalletDataSource, APICoinDataSource $apiCoinDataSource)
    {
        $this->cacheWalletDataSource = $cacheWalletDataSource;
        $this->apiCoinDataSource = $apiCoinDataSource;
    }

    public function execute($coinId, $walletId, $amountUsd): void
    {
        $wallet = $this->cacheWalletDataSource->findById($walletId);
        $coin = $this->apiCoinDataSource->getById($coinId, $amountUsd);
        $wallet->insertCoin($coin);
        Cache::put('wallet:' . $walletId, $wallet);
    }
}
