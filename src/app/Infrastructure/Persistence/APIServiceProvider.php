<?php

namespace App\Infrastructure\Persistence;

class APIServiceProvider
{
    public function Coins(){
        $url = 'https://api.coinlore.net/api/tickers/?start=0&limit=100';
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $datos = json_decode($response, true);

        $id = $datos["data"][0]["id"];

        return $id;
    }

    public function Coin($id){
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $id;
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $datos = json_decode($response, true);

        $name = $datos[0]["name"];

        return $name;
    }

    public function CoinPrice($id){
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $id;
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $datos = json_decode($response, true);

        $price = $datos[0]["price_usd"];

        return $price;
    }
}
