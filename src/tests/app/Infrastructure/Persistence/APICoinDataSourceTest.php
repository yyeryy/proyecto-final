<?php

namespace Tests\Infrastructure\Persistence;

use App\Infrastructure\Persistence\APICoinDataSource;
use PHPUnit\Framework\TestCase;

class APICoinDataSourceTest extends TestCase
{
    /**
     * @test
     */
    public function get_coin_by_Id_correctly_test(){
        $APICoinDataSource = new APICoinDataSource();
        $APICoinDataSource->getById(90, 500);
    }

    /**
     * @test
     */
    public function get_coin_by_incorrectly_Id_test(){

    }
}
