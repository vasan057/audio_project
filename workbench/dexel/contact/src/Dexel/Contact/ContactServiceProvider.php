<?php namespace Dexel\Contact;

use Illuminate\Support\ServiceProvider;
use Dexel\Contact\Console\Commands\ContactCommand;

/**
 * The ContactServiceProvider class
 *
 * @package Dexel\Contact
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class ContactServiceProvider extends ServiceProvider
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
        $this->app->singleton('contact', function ($app) {
            return new Contact;
        });

        $this->app->singleton('command.contact', function ($app) {
            return new ContactCommand;
        });

        $this->commands('command.contact');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'contact',
            'command.contact',
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
        $appConfigPath     = config_path('contact.php');

        $this->mergeConfigFrom($packageConfigPath, 'contact');

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

        $this->loadTranslationsFrom($packageTranslationsPath, 'contact');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/contact'),
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

        $this->loadViewsFrom($packageViewsPath, 'contact');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/contact'),
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
            $packageAssetsPath => public_path('vendor/contact'),
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
