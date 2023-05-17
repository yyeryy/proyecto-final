<?php

namespace Tests\app\Infrastructure\Controller;

use App\Infrastructure\Controllers\CreateWalletFormRequest;
use PHPUnit\Framework\TestCase;

class CreateWalletFormRequestTest extends TestCase
{
    /**
     * @test
     */
    public function formRequest_validates_user_id_parameter()
    {
        $createWalletFormRequest = new CreateWalletFormRequest();

        $rules = $createWalletFormRequest->rules();
        $this->assertArrayHasKey('user_id', $rules);
        $this->assertStringContainsString('required', $rules['user_id']);
        $this->assertStringContainsString('string', $rules['user_id']);
    }
}
