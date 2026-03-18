<?php

namespace VitNasinec\Image;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Glide\ServerFactory;
use VitNasinec\Image\Responses\LaravelResponseFactory;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ImageServer', function ($app) {

            $filesystem = $app->make(Filesystem::class);

            return ServerFactory::create([
                'response' => new LaravelResponseFactory,
                'source' => $filesystem->getDriver(),
                'cache' => storage_path('framework/cache/data/glide'),
                'base_url' => config('image.prefix'),
                'driver' => config('image.driver'),
            ]);
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/image.php', 'image');
        $this->publishes([
            __DIR__.'/../config/image.php' => config_path('image.php'),
        ], 'image-config');

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
