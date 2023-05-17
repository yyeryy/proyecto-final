<?php

namespace App\Domain;

use App\Application\CoinDataSource;

class Coin
{
    private int $coin_id;
    private string $name;
    private string $symbol;
    private float $amount;
    private float $value_usd;

    /**
     * @param int $coin_id
     * @param string $name
     * @param string $symbol
     * @param float $amount
     * @param float $value_usd
     */
    public function __construct(int $coin_id, string $name, string $symbol, float $amount, float $value_usd)
    {
        $this->coin_id = $coin_id;
        $this->name = $name;
        $this->symbol = $symbol;
        $this->amount = $amount;
        $this->value_usd = $value_usd;
    }

    /**
     * @return int
     */
    public function getCoinId(): int
    {
        return $this->coin_id;
    }

    /**
     * @param int $coin_id
     */
    public function setCoinId(int $coin_id): void
    {
        $this->coin_id = $coin_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     */
    public function setSymbol(string $symbol): void
    {
        $this->symbol = $symbol;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function getValueUsd(): float
    {
        return $this->value_usd;
    }

    /**
     * @param float $value_usd
     */
    public function setValueUsd(float $value_usd): void
    {
        $this->value_usd = $value_usd;
    }
}
