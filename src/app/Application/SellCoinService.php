<?php

namespace App\Application;

use Illuminate\Support\Facades\Cache;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class SellCoinService
{
    private CacheWalletDataSource $cacheWallet;
    private APICoinDataSource $apiCoinDataSource;

    public function __construct(CacheWalletDataSource $cacheWallet, APICoinDataSource $apiCoinDataSource)
    {
        $this->cacheWallet = $cacheWallet;
        $this->apiCoinDataSource = $apiCoinDataSource;
    }

    public function execute($coinId, $walletId, $amountUsd): void
    {
        $wallet = $this->cacheWallet->findById($walletId);
        $coin = $this->apiCoinDataSource->getById($coinId, $amountUsd);
        $wallet->sellCoin($coin);
        Cache::put('wallet:' . $walletId, $wallet);
    }
}
