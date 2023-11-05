<?php

namespace VitNasinec\Image;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use League\Glide\Responses\SymfonyResponseFactory;
use League\Glide\ServerFactory;

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
                'response' => new SymfonyResponseFactory,
                'source' => $filesystem->getDriver(),
                'cache' => storage_path('framework/cache/data/glide'),
                'base_url' => 'image',
                'driver' => env('IMAGE_DRIVER', 'gd'),
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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }
}
