<?php

namespace App\Providers;

use Cloudinary\Cloudinary;
use CloudinaryLabs\CloudinaryLaravel\CloudinaryStorageAdapter;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Safely register Cloudinary singleton — won't crash if env vars are missing
        $this->app->singleton(Cloudinary::class, function ($app) {
            $config = $app['config']->get('filesystems.disks.cloudinary', []);
            $cloud  = $config['cloud']  ?? null;
            $key    = $config['key']    ?? null;
            $secret = $config['secret'] ?? null;

            if ($cloud && $key && $secret) {
                return new Cloudinary([
                    'cloud' => [
                        'cloud_name' => $cloud,
                        'api_key'    => $key,
                        'api_secret' => $secret,
                    ],
                    'url' => ['secure' => true],
                ]);
            }

            // No credentials — return empty instance so app boots without crashing
            // (upload calls will fail only when actually attempted, not on boot)
            try {
                return new Cloudinary(null);
            } catch (\Throwable $e) {
                return new Cloudinary(['cloud' => ['cloud_name' => 'placeholder', 'api_key' => 'placeholder', 'api_secret' => 'placeholder']]);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (str_contains(request()->getHost(), 'ngrok') || str_contains(request()->getHost(), 'vercel.app') || app()->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Manually register Cloudinary filesystem disk (since auto-discovery is disabled)
        $this->app['filesystem']->extend('cloudinary', function ($app, $config) {
            $cloud  = $config['cloud']  ?? null;
            $key    = $config['key']    ?? null;
            $secret = $config['secret'] ?? null;

            if ($cloud && $key && $secret) {
                $cloudinary = new Cloudinary([
                    'cloud' => [
                        'cloud_name' => $cloud,
                        'api_key'    => $key,
                        'api_secret' => $secret,
                    ],
                    'url' => ['secure' => true],
                ]);
                $adapter = new CloudinaryStorageAdapter($cloudinary, null, $config['prefix'] ?? null);
                return new FilesystemAdapter(new Filesystem($adapter, $config), $adapter, $config);
            }

            return null; // Disk not available without credentials
        });
    }
}
