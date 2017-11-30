<?php namespace Dexel\Audio;

use Illuminate\Support\ServiceProvider;

/**
 * AudioServiceProvider
 *
 * @package Dexel\Audio
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class AudioServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $packageRoutesPath       = __DIR__ . '/../../routes/web.php';
        $packageConfigPath       = __DIR__ . '/../../config/config.php';
        $packageMigrationsPath   = __DIR__ . '/../../migrations';
        $packageAssetsPath       = __DIR__ . '/../../resources/assets';
        $packageTranslationsPath = __DIR__ . '/../../resources/lang';
        $packageViewsPath        = __DIR__ . '/../../resources/views';

        /**
         * Loading package's routes and controllers
         */
        include $packageRoutesPath;

        /**
         * Loading and publishing package's config
         */
        $appConfigPath = config_path('audio.php');

        $this->mergeConfigFrom($packageConfigPath, 'audio');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');

        /**
         * Loading and publishing package's translations
         */
        $this->loadTranslationsFrom($packageTranslationsPath, 'audio');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/audio'),
        ], 'lang');

        /**
         * Loading and publishing package's views
         */
        $this->loadViewsFrom($packageViewsPath, 'audio');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/audio'),
        ], 'views');

        /**
         * Publishing package's assets (JavaScript, CSS, images...)
         */
        $this->publishes([
            $packageAssetsPath => public_path('vendor/audio'),
        ], 'public');

        /**
         * Loading and publishing package's migrations
         */
        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('/migrations')
        ], 'migrations');

        //audio vaidation
        \Validator::extend('audio', function($attribute, $value, $parameters) {
            if (!($value instanceof \Symfony\Component\HttpFoundation\File\UploadedFile)) return false;
        return in_array(
            preg_replace(
                [
                    '/application\/octet-stream/',
                    '/audio\/mpga/',
                    '/audio\/mpeg/',
                    '/audio\/x-wav/',
                    '/application\/ogg/',
                ], 
                [
                    'mp3',
                    'mp3',
                    'wav',
                    'ogg',
                ], 
                $value->getMimeType()
            ),
            $parameters
        );
        /* To use
        $validator = Validator::make(
          [
            'audio'     => $request->file('audio'),
            'audiomp3'  => $request->file('audiomp3'),
          ],
          [
            'audio'     => 'audio:mp3,wav,ogg',
            'audiomp3'  => 'audio:mp3',
          ]
        );*/
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('audio', function ($app) {
            return new Audio;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['audio'];
    }
}
