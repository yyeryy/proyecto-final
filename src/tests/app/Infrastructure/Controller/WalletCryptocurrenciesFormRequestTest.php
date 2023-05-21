<?php

namespace Tests\app\Infrastructure\Controller;

use PHPUnit\Framework\TestCase;

class WalletCryptocurrenciesFormRequestTest extends TestCase
{

    /**
     * @test
     */
    public function formRequest_validates_coin_id_parameter()
    {
        $createWalletFormRequest = new CreateWalletFormRequest();

        $rules = $createWalletFormRequest->rules();
        $this->assertArrayHasKey('coin_id', $rules);
        $this->assertStringContainsString('required', $rules['coin_id']);
        $this->assertStringContainsString('string', $rules['coin_id']);
    }

    /**
     * @test
     */
    public function formRequest_validates_name_parameter()
    {
        $createWalletFormRequest = new CreateWalletFormRequest();

        $rules = $createWalletFormRequest->rules();
        $this->assertArrayHasKey('name', $rules);
        $this->assertStringContainsString('required', $rules['name']);
        $this->assertStringContainsString('string', $rules['name']);
    }
}
