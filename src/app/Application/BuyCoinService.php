<?php

namespace App\Application;


use App\Domain\Wallet;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Cache;
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


    public function execute($coinId, $walletId, $amountUsd): void
    {
            $wallet = $this->cacheWalletDataSource->findById($walletId);
            $coin = $this->apiCoinDataSource->getById($coinId, $amountUsd);
            $wallet->insertCoin($coin);
            Cache::put('wallet:' . $walletId, $wallet);
    }
}
