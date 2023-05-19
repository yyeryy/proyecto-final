<?php

namespace App\Domain;

use App\Domain\WalletDataSource;

class Wallet
{
    private string $wallet_id;
    private array $coins;

    public function __construct(string $id)
    {
        $this->wallet_id = $id;
        $this->coins = array();
    }

    public function getId(): String
    {
        return $this->wallet_id;
    }

    public function getCoin(): array
    {
        return $this->coins;
    }

    public function setId(String $id): void
    {
        $this->wallet_id = $id;
    }

    public function setCoin($coins)
    {
        $this->coins = $coins;
    }

    public function open(string $id): Wallet
    {
        $wallet = new Wallet($id);
        return $wallet;
    }

    public function insertCoin(Coin $coin){
        //$key = array_search($coin->getCoinId(), $this->coins);
        $bool = false;
        $key = 0;
        foreach ($this->coins as $oldCoin){
            if($oldCoin->getCoinId() == $coin->getCoinId()){
                $bool = true;
                break;
            }
            $key++;
        }
        if($bool){
            $this->coins[$key]->setAmount(($this->coins[$key]->getAmount()) + $coin->getAmount());
            $this->coins[$key]->setValueUsd(($this->coins[$key]->getValueUsd()) + $coin->getValueUsd());
        }else{
            array_push($this->coins, $coin);
        }
    }

    public function sellCoin(Coin $coin){
        $key = array_search($coin, $this->coins);
        if($key){
            if($this->coins[$key]->getAmount() > $coin->getAmount()){
                $this->coins[$key]->setAmount($this->coins[$key]->getAmount() - $coin->getAmount());
            } else if($this->coins[$key]->getAmount() == $coin->getAmount()){
                array_splice($this->coins, $key, 1);
            }
        } else {
            array_splice($this->coins, $key, 1);
        }
    }

}
