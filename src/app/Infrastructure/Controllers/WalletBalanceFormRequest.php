<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class WalletBalanceFormRequest extends FormRequest
{
    public function rules()
    {
        return[
            'wallet_id' => 'required|string'
        ];
    }
}
