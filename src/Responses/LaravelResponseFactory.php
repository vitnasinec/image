<?php

declare(strict_types=1);

namespace VitNasinec\Image\Responses;

use League\Flysystem\FilesystemOperator;
use League\Glide\Responses\ResponseFactoryInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaravelResponseFactory implements ResponseFactoryInterface
{
    public function create(FilesystemOperator $cache, string $path): StreamedResponse
    {
        $stream = $cache->readStream($path);

        return new StreamedResponse(
            function () use ($stream): void {
                if (ftell($stream) !== 0) {
                    rewind($stream);
                }
                fpassthru($stream);
                fclose($stream);
            },
            200,
            [
                'Content-Type' => $cache->mimeType($path),
                'Content-Length' => $cache->fileSize($path),
                'Cache-Control' => 'max-age=31536000, public',
            ]
        );
    }
}
