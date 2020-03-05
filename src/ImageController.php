<?php

namespace VitNasinec\Image;

use Illuminate\Http\Request;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;

class ImageController
{
    /**
     * __invoke
     *
     * @param Request $request
     * @param mixed $path
     * @return mixed
     */
    public function __invoke(Request $request, $path)
    {
        return app('ImageServer')->getImageResponse(
            $path,
            $request->all()
        );
    }
}
