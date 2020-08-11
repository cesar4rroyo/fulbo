<?php

namespace App\Providers;

use App\Observers\TempatPenyewaanObserver;
use App\TempatPenyewaan;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\DateFactory;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Date\Date;

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
        TempatPenyewaan::observe(TempatPenyewaanObserver::class);
        DateFactory::useClass(Date::class);

        $this->app->bind("indexProvider", function () {
            return new class() {
                private $index = 1;

                public function index()
                {
                    return $this->index++;
                }

                public function reset()
                {
                    $this->index = 1;
                }
            };
        });

        $this->app->extend(Generator::class, function (Generator $generator, Container $container) {
            $generator->addProvider($container->get("indexProvider"));
            return $generator;
        });
    }
}
