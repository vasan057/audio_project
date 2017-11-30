<?php namespace Dexel\Follow;

use Illuminate\Support\ServiceProvider;
use Dexel\Follow\Console\Commands\FollowCommand;

/**
 * The FollowServiceProvider class
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class FollowServiceProvider extends ServiceProvider
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
        // Bootstrap handles
        $this->routeHandle();
        $this->configHandle();
        $this->langHandle();
        $this->viewHandle();
        $this->assetHandle();
        $this->migrationHandle();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('follow', function ($app) {
            return new Follow;
        });

        $this->app->singleton('command.follow', function ($app) {
            return new FollowCommand;
        });

        $this->commands('command.follow');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'follow',
            'command.follow',
        ];
    }

    /**
     * Loading package routes
     *
     * @return void
     */
    protected function routeHandle()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Loading and publishing package's config
     *
     * @return void
     */
    protected function configHandle()
    {
        $packageConfigPath = __DIR__.'/../../config/config.php';
        $appConfigPath     = config_path('follow.php');

        $this->mergeConfigFrom($packageConfigPath, 'follow');

        $this->publishes([
            $packageConfigPath => $appConfigPath,
        ], 'config');
    }

    /**
     * Loading and publishing package's translations
     *
     * @return void
     */
    protected function langHandle()
    {
        $packageTranslationsPath = __DIR__.'/../../resources/lang';

        $this->loadTranslationsFrom($packageTranslationsPath, 'follow');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/follow'),
        ], 'lang');
    }

    /**
     * Loading and publishing package's views
     *
     * @return void
     */
    protected function viewHandle()
    {
        $packageViewsPath = __DIR__.'/../../resources/views';

        $this->loadViewsFrom($packageViewsPath, 'follow');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/follow'),
        ], 'views');
    }

    /**
     * Publishing package's assets (JavaScript, CSS, images...)
     *
     * @return void
     */
    protected function assetHandle()
    {
        $packageAssetsPath = __DIR__.'/../../resources/assets';

        $this->publishes([
            $packageAssetsPath => public_path('vendor/follow'),
        ], 'public');
    }

    /**
     * Publishing package's migrations
     *
     * @return void
     */
    protected function migrationHandle()
    {
        $packageMigrationsPath = __DIR__.'/../../database/migrations';

        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('migrations')
        ], 'migrations');
    }
}
