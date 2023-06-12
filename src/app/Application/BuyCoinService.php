<?php

namespace App\Application;

use App\Domain\CoinDataSource;
use App\Domain\Wallet;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Util\Exception;
use Symfony\Component\DependencyInjection\Exception\ExceptionInterface;

class BuyCoinService
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
        $wallet->insertCoin($coin);
        Cache::put('wallet:' . $walletId, $wallet);
    }
}
