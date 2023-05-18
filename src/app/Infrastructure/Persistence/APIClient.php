<?php

namespace App\Infrastructure\Persistence;

class APIClient
{
    public function getCoinDataWithId($coinId){
        $url = 'https://api.coinlore.net/api/ticker/?id=' . $coinId;
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        return json_decode($response, true);
    }
}
