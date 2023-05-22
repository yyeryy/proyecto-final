<?php

namespace Tests\Application;

use App\Application\WalletCryptocurrenciesService;
use App\Domain\Wallet;
use Mockery;
use PHPUnit\Framework\TestCase;

class WalletCryptocurrenciesServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->WalletCryptocurrenciesServiceMock = Mockery::mock(WalletCryptocurrenciesService::class);
    }
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
    /**
     * @test
     */
    public function execute_create_wallet_with_existing_wallet_id_test(){
        $wallet = new Wallet('1');
        $this->WalletCryptocurrenciesServiceMock->shouldReceive('execute')->once()->with('1')->andReturn($wallet);
        $result = $this->WalletCryptocurrenciesServiceMock->execute('1');
        $this->assertEquals($wallet, $result);
    }
}
