<?php

namespace App\Domain;

use App\Domain\UserDataSource;

class User
{
    private string $user_id;
    private Wallet $wallet;

    public function __construct(string $user_id, Wallet $wallet)
    {
        $this->user_id = $user_id;
        $this->wallet = $wallet;
    }

    public function getId(): string
    {
        return $this->user_id;
    }

    public function setId(string $user_id): void
    {
        $this->user_id = $user_id;
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
