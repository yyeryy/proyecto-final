<?php

namespace App\Infrastructure\Controllers;
use Illuminate\Foundation\Http\FormRequest;


class CreateWalletFormRequest extends FormRequest
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
