<?php

namespace App\Domain;

class Wallet
{
    private string $wallet_id;

    public function __construct(string $id)
    {
        $this->wallet_id = $id;
    }

    public function open(string $id): Wallet
    {
        $wallet = new Wallet($id);
        return $wallet;
    }

}
