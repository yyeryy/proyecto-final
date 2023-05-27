<?php

namespace App\Application;

use App\Domain\CoinDataSource;
use App\Domain\WalletDataSource;
use Illuminate\Support\Facades\Cache;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;

class SellCoinService
{
    private WalletDataSource $walletDataSource;
    private CoinDataSource $coinDataSource;

    public function __construct(WalletDataSource $walletDataSource, CoinDataSource $coinDataSource)
    {
        $this->walletDataSource = $walletDataSource;
        $this->coinDataSource = $coinDataSource;
    }

    public function execute($coinId, $walletId, $amountUsd): void
    {
        $wallet = $this->walletDataSource->findById($walletId);
        $coin = $this->coinDataSource->getById($coinId, $amountUsd);
        $wallet->sellCoin($coin);
        Cache::put('wallet:' . $walletId, $wallet);
    }
}
