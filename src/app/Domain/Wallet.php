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
        array_push($this->coins, $coin);
    }

}
