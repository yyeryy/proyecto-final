<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    // Atributos
    /**
     * @var private string $coin_id;
     * @var private string $name;
     * @var private string $symbol;
     * @var private float $amount;
     * @var private float $value_usd;
     */

    // Getters
    public function getCoin_id();
    public function getName();
    public function getSymbol();
    public function getAmount();
    public function getValue_usd();

    // Setters
    public function setCoin_id();
    public function setName();
    public function setSymbol();
    public function setAmount();
    public function setValue_usd();

    // Funciones
    /**
     * Permite comprar $amount_usd cantidad de la moneda.
     * @param float $amount_usd: Cantidad en dolares a comprar.
     * @return int: Resultado de la ejecución de la función.
     */
    public function buy(float $amount_usd): int;

    /**
     * Permite vender $amount_usd cantidad de la moneda.
     * @param float $amount_usd: Cantidad en dolares a vender.
     * @return int: Resultado de la ejecución de la función.
     */
    public function sell(float $amount_usd): int;

}
