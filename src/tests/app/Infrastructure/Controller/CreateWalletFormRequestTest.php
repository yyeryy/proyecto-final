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

        $result = $createWalletFormRequest->validate("1");
        $this->assertEquals("Ok", $result);
    }
}
