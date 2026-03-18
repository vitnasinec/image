<?php

use Illuminate\Support\Facades\Route;
use VitNasinec\Image\ImageController;

Route::get('/'.config('image.prefix').'/{path}', ImageController::class)
    ->name('image')
    ->where('path', '.*');
