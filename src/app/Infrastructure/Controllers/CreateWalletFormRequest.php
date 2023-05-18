<?php

namespace App\Infrastructure\Controllers;
use Illuminate\Foundation\Http\FormRequest;


class CreateWalletFormRequest extends FormRequest
{
    //validamos parametro user_id
    //Recibimos parametro user_id
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "user_id.required" => "ERROR: Parametros incorrectos"
        ];
    }
}
