<?php

namespace App\Application;

use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class WalletBalanceService
{
    private CacheWalletDataSource $cacheWallet;
    private APICoinDataSource $apiCoinDataSource;

    public function __construct(CacheWalletDataSource $cacheWallet, APICoinDataSource $apiCoinDataSource)
    {
        $this->cacheWallet = $cacheWallet;
        $this->apiCoinDataSource = $apiCoinDataSource;
    }
    public function execute($walletId)
    {
        $wallet = $this->cacheWallet->findById($walletId);
        $coins = $wallet->getCoin();
        if (empty($coins)) {
            throw new Exception("Coin Not found exception");
        }
        $coins_str = "";
        foreach ($coins as $coin) {
            $coins_str .= $coin->getCoinId() . ",";
        }
        $coins_str .= "0";
        $price_array = $this->apiCoinDataSource->getBalanceById($coins_str);
        $balance = 0;
        for ($i = 0; $i < count($coins); $i++) {
            $balance += (($price_array[$i] * $coins[$i]->getAmount()) - ($coins[$i]->getValueUsd()));
        }
        return $balance . "$";
    }
}
