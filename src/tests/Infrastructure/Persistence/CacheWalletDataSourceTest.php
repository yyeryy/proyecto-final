<?php

namespace Tests\Infrastructure\Persistence;

use App\Infrastructure\Persistence\CacheWalletDataSource;
use PHPUnit\Framework\TestCase;

class CacheWalletDataSourceTest extends TestCase
{

    public function testFindById()
    {

    }

    public function testCreateWallet()
    {
        $cacheWalletDataSource = new CacheWalletDataSource();

        $result = $cacheWalletDataSource->createWallet("1");
        $this->assertEquals($result, "1");
    }
}
