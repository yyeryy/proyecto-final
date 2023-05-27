<?php

namespace App\Application;

use App\Domain\CoinDataSource;
use App\Domain\WalletDataSource;
use App\Infrastructure\Persistence\APICoinDataSource;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Util\Exception;

class WalletBalanceService
{
    private WalletDataSource $walletDataSource;
    private CoinDataSource $coinDataSource;

    public function __construct(WalletDataSource $walletDataSource, CoinDataSource $coinDataSource)
    {
        $this->walletDataSource = $walletDataSource;
        $this->coinDataSource = $coinDataSource;
    }
    public function execute($walletId){
        $wallet = $this->walletDataSource->findById($walletId);
        $coins = $wallet->getCoin();
        if(empty($coins)){
            throw new Exception("Coin Not found exception");
        }
        $coins_str = "";
        foreach ($coins as $coin) {
            $coins_str .= $coin->getCoinId() . ",";
        }
        $coins_str .= "0";
        $price_array = $this->coinDataSource->getBalanceById($coins_str);
        $balance = 0;
        for($i = 0; $i<count($coins); $i++){
            $balance += (($price_array[$i] * $coins[$i]->getAmount()) - ($coins[$i]->getValueUsd()));
        }
        return $balance . "$";
    }
}
