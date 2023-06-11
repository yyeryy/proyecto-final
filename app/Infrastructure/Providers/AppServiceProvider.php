<?php

namespace App\Infrastructure\Providers;

use App\DataSource\Database\EloquentUserDataSource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        $this->app->bind(UserDataSource::class, function () {
            return new EloquentUserDataSource();
        });

        $this->app->bind(WalletDataSource::class, function () {
            return new WalletDataSourceImplementation();
        });

        $this->app->bind(CoinDataSource::class, function () {
            return new CoinDataSourceImplementation();
        });
        */
    }
}
