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
    public function setCoin_id($coin_id);
    public function setName($name);
    public function setSymbol($symbol);
    public function setAmount($amount);
    public function setValue_usd($value_usd);

    // Funciones
    /**
     * Permite comprar $amount_usd cantidad de la moneda.
     * @param float $amount: Cantidad de la moneda a comprar.
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se ha comprado la moneda)
     *  400: Error. (Mete un try-catch)
     *  401: Error. (Se ha intenado comprar un número invalido de monedas, ejemplo negativos)
     */
    public function buy(float $amount): int;

    /**
     * Permite vender $amount_usd cantidad de la moneda.
     * @param float $amount: Cantidad de la moneda a vender.
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se ha vendido la moneda)
     *  400: Error. (Mete un try-catch)
     *  401: Error. (Se ha intentado vender un número invalido de monedas, ejemplo negativos)
     *  402: Error. (Se ha intentado vender una cantida superior a la que se tiene)
     */
    public function sellCoin(string $coin_id, string $wallet_id, float $amount_usd): int;
}
