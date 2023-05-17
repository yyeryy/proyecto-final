<?php

namespace App\Infrastructure\Controllers;

class CreateWalletFormRequest
{
    //validamos parametro user_id
    //Recibimos parametro user_id

    public function rules()
    {
        return [
            'user_id' => 'required|string'
        ];
    }
}
