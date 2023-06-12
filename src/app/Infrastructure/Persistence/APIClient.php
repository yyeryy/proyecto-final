<?php

namespace App\Infrastructure\Persistence;

use Exception;

class APIClient
{
    public function getCoinDataWithId($coinId)
    {
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $coinId;
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        if (json_decode($response, true) == null) {
            throw new Exception("Coin Not found exception");
        }
        return json_decode($response, true);
    }
}
