<?php

namespace App\Domain;

class User
{
    private int $id;
    private Wallet $wallet;

    public function __construct(int $id, Wallet $wallet)
    {
        $this->id = $id;
        $this->wallet = $wallet;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): void
    {
        $this->wallet = $wallet;
    }
}
