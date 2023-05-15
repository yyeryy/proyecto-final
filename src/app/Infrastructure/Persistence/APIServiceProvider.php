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
        return $datos;
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
        return $datos;
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
        return $datos;
    }
}
