<?php

use Illuminate\Support\Facades\Route;
use VitNasinec\Image\ImageController;

Route::get('/image/{path}', ImageController::class)
    ->name('image')
    ->where('path', '.*');
