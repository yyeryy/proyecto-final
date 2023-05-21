<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class WalletBalanceFormRequest extends FormRequest
{
    public function rules()
    {
        return[
            'coin_id' => 'required|string',
            'wallet_id' => 'required|string',
            'amount_usd' => 'required|numeric'
        ];
    }
}
