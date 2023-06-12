<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\WalletBalanceFormRequest;
use PHPUnit\Framework\TestCase;

class WalletBalanceFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequestValidatesWalletBalance()
    {
        $walletBalance = new WalletBalanceFormRequest();

        $rules = $walletBalance->rules();

        $this->assertArrayHasKey('wallet_id', $rules);
        $this->assertStringContainsString('required', $rules['wallet_id']);
        $this->assertStringContainsString('string', $rules['wallet_id']);
    }
}
