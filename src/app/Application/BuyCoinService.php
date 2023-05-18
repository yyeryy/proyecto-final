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

    public function execute($coinId, $walletId, $amountUsd): void
    {
            $this->cacheWalletDataSource->findById($walletId);
            $this->apiCoinDataSource->getById($coinId, $amountUsd);
    }
}
