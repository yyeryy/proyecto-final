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
     * Muesra (print) la id de la cartera nueva que se crea al llamar a esta función.
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se han mostrado)
     *  400: Error. (Mete un try-catch)
     *  401: Error. (El usuario ya tiene una cartera)
     */
    public function open(): int;

    /**
     * Muestra (print) la información de la cartera, mostrando información de la lista de monedas que posee la cartera.
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se han mostrado)
     *  400: Error. (Mete un try-catch)
     */
    public function info(): int;

    /**
     * Muestra (print) el balance de la cartera (la diferencia entre los precios de compra y los actuales de venta)
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se han mostrado)
     *  400: Error. (Mete un try-catch)
     */
    public function balance(): int;

    /**
     * Muestra (print) las monedas disponibles para su compra.
     * @return int: Resultado de la ejecución de la función.
     *  200: Exito. (Se han mostrado)
     *  400: Error. (Mete un try-catch)
     */
    public function mostrarTop100Monedas(): int;
}
