<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\SellCoinFormRequest;
use PHPUnit\Framework\TestCase;

class SellCoinFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequestValidatesSellCoinParameter()
    {
        $sellCoinFormRequest = new SellCoinFormRequest();

        $rules = $sellCoinFormRequest->rules();

        $this->assertArrayHasKey('coin_id', $rules);
        $this->assertStringContainsString('required', $rules['coin_id']);
        $this->assertStringContainsString('string', $rules['coin_id']);

        $this->assertArrayHasKey('wallet_id', $rules);
        $this->assertStringContainsString('required', $rules['wallet_id']);
        $this->assertStringContainsString('string', $rules['wallet_id']);

        $this->assertArrayHasKey('amount_usd', $rules);
        $this->assertStringContainsString('required', $rules['amount_usd']);
        $this->assertStringContainsString('numeric', $rules['amount_usd']);
    }
}
