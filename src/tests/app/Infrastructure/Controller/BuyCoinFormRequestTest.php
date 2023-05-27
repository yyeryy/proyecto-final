<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\BuyCoinFormRequest;
use PHPUnit\Framework\TestCase;

class BuyCoinFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequest_validates_buy_coin_parameter()
    {
        $buyCoinFormRequest = new BuyCoinFormRequest();

        $rules = $buyCoinFormRequest->rules();

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
