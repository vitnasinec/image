<?php

namespace VitNasinec\Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Exception\NotReadableException;
use League\Glide\Filesystem\FileNotFoundException;

class ImageController
{
    public function __invoke(Request $request, $path)
    {
        if ($request->has('original')
            || ! count($request->all())
            || Str::endsWith($path, '.svg')
        ) {
            abort_if(! Storage::exists($path), 404);

            return Storage::response($path);
        }

        try {
            return app('ImageServer')->getImageResponse(
                $path,
                $request->all()
            );
        } catch (FileNotFoundException $e) {
            abort(404);
        } catch (NotReadableException $e) {
            abort(415, $e->getMessage());
        }
    }
}
