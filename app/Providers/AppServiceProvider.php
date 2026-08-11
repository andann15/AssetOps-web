<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Safely register Cloudinary so it doesn't crash if CLOUDINARY_URL is not set
        $this->app->singleton(\Cloudinary\Cloudinary::class, function ($app) {
            $config = $app['config']->get('filesystems.disks.cloudinary', []);
            $url = $config['url'] ?? null;

            if ($url) {
                return new \Cloudinary\Cloudinary($url);
            }

            $cloud  = $config['cloud'] ?? null;
            $key    = $config['key'] ?? null;
            $secret = $config['secret'] ?? null;

            if ($cloud && $key && $secret) {
                return new \Cloudinary\Cloudinary([
                    'cloud' => [
                        'cloud_name' => $cloud,
                        'api_key'    => $key,
                        'api_secret' => $secret,
                    ],
                    'url' => ['secure' => $config['secure'] ?? true],
                ]);
            }

            // Return an unconfigured Cloudinary instance — upload calls will fail
            // gracefully instead of crashing the entire app on boot.
            return new \Cloudinary\Cloudinary([]);
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
    }
}
