<?php

namespace Tests\app\Infrastructure\Persistence;

use App\Domain\Wallet;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\TestCase;
use App\Domain\User;
use App\Infrastructure\Persistence\CacheUserDataSource;
use Mockery;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class CacheUserDataSourceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->cacheMock = Mockery::mock('alias:' . Cache::class);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function testGetUserFromCache()
    {
        $expectedUser = new User(1, new Wallet('1'));

        $user = $this->cacheMock->shouldReceive('get')->once()->with('user:1')->andReturn($expectedUser);

        $cacheUserDataSource = new CacheUserDataSource();

        $result = $cacheUserDataSource->getUserFromCache();
        $this->assertEquals($expectedUser, $result);
    }

    /**
     * @test
     */
    public function testFindUserById()
    {
        $expectedUser = new User(1, new Wallet('1'));

        $user = $this->cacheMock->shouldReceive('get')->once()->with('user:1')->andReturn($expectedUser);

        if (!$user) {
            $this->cacheMock->shouldReceive('put')->once()->with('user:1', Mockery::type(User::class));
        }

        $cacheUserDataSource = new CacheUserDataSource();

        $result = $cacheUserDataSource->findUserById('1');
        $this->assertEquals($expectedUser, $result);
    }
}
