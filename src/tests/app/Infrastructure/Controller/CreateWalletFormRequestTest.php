<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\CreateWalletFormRequest;
use PHPUnit\Framework\TestCase;

class CreateWalletFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequestValidatesUserIdParameter()
    {
        $createWallet = new CreateWalletFormRequest();

        $rules = $createWallet->rules();

        $this->assertArrayHasKey('user_id', $rules);
        $this->assertStringContainsString('required', $rules['user_id']);
        $this->assertStringContainsString('string', $rules['user_id']);
    }
}
