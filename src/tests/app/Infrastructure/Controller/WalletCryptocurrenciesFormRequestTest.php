<?php

namespace Tests\app\Infrastructure\Controller;

use PHPUnit\Framework\TestCase;

/**
 * @test
 */
class WalletCryptocurrenciesFormRequestTest extends TestCase
{
    public function formRequest_validates_coin_id_parameter()
    {
        $createWalletFormRequest = new CreateWalletFormRequest();

        $rules = $createWalletFormRequest->rules();
        $this->assertArrayHasKey('coin_id', $rules);
        $this->assertStringContainsString('required', $rules['coin_id']);
        $this->assertStringContainsString('string', $rules['coin_id']);
    }
}
