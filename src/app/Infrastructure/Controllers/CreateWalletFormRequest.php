<?php

namespace App\Infrastructure\Controllers;
use Illuminate\Foundation\Http\FormRequest;

class CreateWalletFormRequest extends FormRequest
{
    public function rules()
    {
        return[
            "user_id" => "required|string",
        ];
    }
}
