<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\WalletCryptocurrenciesFormRequest;
use PHPUnit\Framework\TestCase;

class WalletCryptocurrenciesFormRequestTest extends TestCase
{

    /**
     * @test
     */
    public function formRequest_validates_coin_id_parameter()
    {
        $walletCryptocurrenciesFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletCryptocurrenciesFormRequest->rules();
        $this->assertArrayHasKey('coin_id', $rules);
        $this->assertStringContainsString('required', $rules['coin_id']);
        $this->assertStringContainsString('string', $rules['coin_id']);
    }

    /**
     * @test
     */
    public function formRequest_validates_name_parameter()
    {
        $walletCryptocurrenciesFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletCryptocurrenciesFormRequest->rules();
        $this->assertArrayHasKey('name', $rules);
        $this->assertStringContainsString('required', $rules['name']);
        $this->assertStringContainsString('string', $rules['name']);
    }

    /**
     * @test
     */
    public function formRequest_validates_symbol_parameter()
    {
        $walletCryptocurrenciesFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletCryptocurrenciesFormRequest->rules();
        $this->assertArrayHasKey('symbol', $rules);
        $this->assertStringContainsString('required', $rules['symbol']);
        $this->assertStringContainsString('string', $rules['symbol']);
    }

    /**
     * @test
     */
    public function formRequest_validates_amount_parameter()
    {
        $walletCryptocurrenciesFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletCryptocurrenciesFormRequest->rules();
        $this->assertArrayHasKey('amount', $rules);
        $this->assertStringContainsString('required', $rules['amount']);
        $this->assertStringContainsString('numeric', $rules['amount']);
    }

    /**
     * @test
     */
    public function formRequest_validates_value_usd_parameter()
    {
        $walletCryptocurrenciesFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletCryptocurrenciesFormRequest->rules();
        $this->assertArrayHasKey('value_usd', $rules);
        $this->assertStringContainsString('required', $rules['value_usd']);
        $this->assertStringContainsString('numeric', $rules['value_usd']);
    }
}
