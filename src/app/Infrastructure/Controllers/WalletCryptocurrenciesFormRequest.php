<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class WalletCryptocurrenciesFormRequest extends FormRequest
{
    public function rules()
    {
        return[
            'coin_id' => 'required|string',
            'name' => 'required|string',
            'symbol' => 'required|string',
            'amount' => 'required|numeric',
            'value_usd' => 'required|numeric'
        ];
    }
}
