<?php

namespace Tests\Infrastructure\Persistence;

<<<<<<< HEAD
use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Framework\TestCase;
=======
use App\Domain\Wallet;
use App\Infrastructure\Persistence\CacheWalletDataSource;
use Mockery;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
>>>>>>> rama-javi

class CacheWalletDataSourceTest extends TestCase
{

<<<<<<< HEAD
    public function testFindById()
    {
        //
    }

    public function testCreateWallet()
    {
        $cacheWalletDataSource = new CacheWalletDataSource();

        $result = $cacheWalletDataSource->createWallet("1");
        $this->assertEquals($result, "1");
=======
    public function testCreateWallet()
    {
        // Simular la fachada Cache
        $cacheMock = Mockery::mock('alias:'.Cache::class);

        // Configurar expectativas en la caché simulada
        $userid = '1';
        $wallet = new Wallet($userid);
        $cacheMock->shouldReceive('get')->with('wallet:' . $userid)->andReturn(null);
        $cacheMock->shouldReceive('put')->with('wallet:' . $userid, $wallet);

        // Crear una instancia de CacheWalletDataSource
        $cacheWalletDataSource = new CacheWalletDataSource();

        // Llamar a la función createWallet
        $result = $cacheWalletDataSource->createWallet($userid);

        // Verificar las aserciones
        $this->assertInstanceOf(Wallet::class, $result);
        $this->assertSame($wallet, $result);
>>>>>>> rama-javi
    }
}
