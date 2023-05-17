<?php

namespace App\Domain;

use App\Application\WalletDataSource\private;

Interface WalletDataSource
{
    // Atributos
    /**
     * @var private string wallet_id; Identificador de la moneda.
     * @var private Coin coin[]; Lista de monedas.
     */

    // Getters
    public function getWallet_id(): string;
    public function getCoin(): Coin;

    // Setters
    public function setWallet_id($wallet_id);
    public function setCoin($coin);

    // Función
    /**
     * Permite abrir una cartera nueva.
     * @return int: Resultado de la ejecución de la función.
     */
    public function open(): int;

    /**
     * Permite consultar la información de la cartera, mostrando información de la lista de monedas.
     */
    public function info(): int;

    /**
     * Permite consultar el balance de la cartera (la diferencia entre los precios de compra y los actuales de venta)
     * @return float: Diferencia de precio entre precio de compra y precio actual de venta.
     */
    public function balance(): float;
}