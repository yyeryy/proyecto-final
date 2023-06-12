<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\WalletCryptocurrenciesFormRequest;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class WalletCryptocurrenciesFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequestValidatesCoinIdParameter()
    {
        $walletFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletFormRequest->rules();
        $this->assertArrayHasKey('coin_id', $rules);
        $this->assertStringContainsString('required', $rules['coin_id']);
        $this->assertStringContainsString('string', $rules['coin_id']);
    }

    /**
     * @test
     */
    public function formRequestValidatesNameParameter()
    {
        $walletFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletFormRequest->rules();
        $this->assertArrayHasKey('name', $rules);
        $this->assertStringContainsString('required', $rules['name']);
        $this->assertStringContainsString('string', $rules['name']);
    }

    /**
     * @test
     */
    public function formRequestValidatesSymbolParameter()
    {
        $walletFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletFormRequest->rules();
        $this->assertArrayHasKey('symbol', $rules);
        $this->assertStringContainsString('required', $rules['symbol']);
        $this->assertStringContainsString('string', $rules['symbol']);
    }

    /**
     * @test
     */
    public function formRequestValidatesAmountParameter()
    {
        $walletFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletFormRequest->rules();
        $this->assertArrayHasKey('amount', $rules);
        $this->assertStringContainsString('required', $rules['amount']);
        $this->assertStringContainsString('numeric', $rules['amount']);
    }

    /**
     * @test
     */
    public function formRequestValidatesValueUsdParameter()
    {
        $walletFormRequest = new WalletCryptocurrenciesFormRequest();

        $rules = $walletFormRequest->rules();
        $this->assertArrayHasKey('value_usd', $rules);
        $this->assertStringContainsString('required', $rules['value_usd']);
        $this->assertStringContainsString('numeric', $rules['value_usd']);
    }
}
