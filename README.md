# Image
Just register and configure league/glide to handle image route requests and display images from your default storage.



## Install

```
composer require vitnasinec/image
```

Requires Laravel 13+ and PHP 8.3+.



## Configuration

Publish the config file:

```
php artisan vendor:publish --tag=image-config
```

Available options in `config/image.php`:

| Key | Env variable | Default | Description |
|---|---|---|---|
| `driver` | `IMAGE_DRIVER` | `gd` | Image driver (`gd` or `imagick`) |
| `prefix` | `IMAGE_PREFIX` | `image` | URL prefix for the image route |



## Usage

Images are served at `/{prefix}/{path}` from your default filesystem disk.

Append query parameters to manipulate images — see the [Glide documentation](https://glide.thephpleague.com) for available options.

Pass `?original` or no parameters to serve the original file. SVG files are always passed through as-is.



## Disclaimer

No tests, no guarantees, no nothing. Just for my personal use. Use at own risk.
