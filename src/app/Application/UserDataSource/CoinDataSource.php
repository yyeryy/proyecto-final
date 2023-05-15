<?php

namespace App\Application\CoinDataSource;

use App\Domain\Coin;

Interface CoinDataSource
{
    // Atributos
    /**
     * @var private string $coin_id; Identificador de la moneda.
     * @var private string $name; Nombre de la moneda.
     * @var private string $symbol; Simbolo de la moneda.
     * @var private float $amount; Cantidad de la moneda.
     * @var private float $value_usd; Valor de compra de la moneda.
     */

    // Getters
    public function getCoin_id(): string;
    public function getName(): string;
    public function getSymbol(): string;
    public function getAmount(): float;
    public function getValue_usd(): float;

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
