<?php

namespace VitNasinec\Image;

use Illuminate\Http\Request;
use League\Glide\Filesystem\FileNotFoundException;
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
        try {
            return app('ImageServer')->getImageResponse(
                $path,
                $request->all()
            );
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }
}
