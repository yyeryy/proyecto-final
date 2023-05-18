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
        $coins = array();
    }

    public function getId(): String
    {
        return $this->wallet_id;
    }

    public function setId(String $id): void
    {
        $this->wallet_id = $id;
    }

    public function open(string $id): Wallet
    {
        $wallet = new Wallet($id);
        return $wallet;
    }

}
