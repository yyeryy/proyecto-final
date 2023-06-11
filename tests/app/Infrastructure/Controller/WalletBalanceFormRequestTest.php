<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\WalletBalanceFormRequest;
use PHPUnit\Framework\TestCase;

class WalletBalanceFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequest_validates_wallet_balance()
    {
        $walletBalanceFormRequest = new WalletBalanceFormRequest();

        $rules = $walletBalanceFormRequest->rules();

        $this->assertArrayHasKey('wallet_id', $rules);
        $this->assertStringContainsString('required', $rules['wallet_id']);
        $this->assertStringContainsString('string', $rules['wallet_id']);
    }
}
