<?php namespace Dexel\Sciences;

use Illuminate\Support\ServiceProvider;

/**
 * SciencesServiceProvider
 *
 * @package Dexel\Sciences
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class SciencesServiceProvider extends ServiceProvider
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
        $appConfigPath = config_path('sciences.php');

        $this->mergeConfigFrom($packageConfigPath, 'sciences');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');

        /**
         * Loading and publishing package's translations
         */
        $this->loadTranslationsFrom($packageTranslationsPath, 'sciences');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/sciences'),
        ], 'lang');

        /**
         * Loading and publishing package's views
         */
        $this->loadViewsFrom($packageViewsPath, 'sciences');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/sciences'),
        ], 'views');

        /**
         * Publishing package's assets (JavaScript, CSS, images...)
         */
        $this->publishes([
            $packageAssetsPath => public_path('vendor/sciences'),
        ], 'public');

        /**
         * Loading and publishing package's migrations
         */
        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sciences', function ($app) {
            return new Sciences;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sciences'];
    }
}
