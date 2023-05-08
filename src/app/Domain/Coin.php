<?php

namespace App\Domain;

class Coin
{
    private int $coin_id;
    private string $name;
    private string $symbol;
    private float $amount;
    private float $value_usd;

    public function __construct(string $name, string $photoUrls)
    {
        $this->name = $name;
        $this->photoUrls = $photoUrls;
    }

    public function getName(): int
    {
        return $this->name;
    }

    public function getPhotoUrls(): int
    {
        return $this->photoUrls;
    }

}
