<?php

namespace App\Domain;

use App\Domain\WalletDataSource;
use PHPUnit\Util\Exception;

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
            $ranks = [];
            foreach ($this->coins as $coin) {
                $ranks[] = $coin->getRank();
            }
            array_multisort($ranks, SORT_ASC, $this->coins);
        }
    }


    public function sellCoin(Coin $coin){
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
            if($this->coins[$key]->getAmount() > $coin->getAmount()){
                $this->coins[$key]->setAmount($this->coins[$key]->getAmount() - $coin->getAmount());
                $this->coins[$key]->setValueUsd($this->coins[$key]->getValueUsd() - $coin->getValueUsd());
            } else if($this->coins[$key]->getAmount() == $coin->getAmount()){
                array_splice($this->coins, $key,1);
            } else{
                throw new Exception("No se puede vender mas de lo que tienes");
            }
        } else {
            throw new Exception("No existe esa moneda en la wallet");
        }
    }

}
