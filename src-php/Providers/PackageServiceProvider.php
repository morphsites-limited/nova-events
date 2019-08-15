<?php

namespace Dewsign\NovaEvents\Providers;

use Laravel\Nova\Nova;
use Illuminate\Routing\Router;
use Dewsign\NovaEvents\Nova\Event;
use Dewsign\NovaEvents\Nova\EventSlot;
use Illuminate\Support\ServiceProvider;
use Dewsign\NovaEvents\Nova\EventCategory;
use Dewsign\NovaEvents\Nova\EventLocation;
use Dewsign\NovaEvents\Nova\EventOrganiser;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishConfigs();
        $this->bootViews();
        $this->bootAssets();
        $this->bootCommands();
        $this->publishDatabaseFiles();
        // $this->registerMiddleware();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::resources([
            Event::class,
            EventSlot::class,
            EventCategory::class,
            EventLocation::class,
            EventOrganiser::class,
        ]);

        $this->mergeConfigFrom(
            $this->getConfigsPath(), 'nova-events'
        );
    }

    /**
     * Publish config files
     *
     * @return void
     */
    private function publishConfigs()
    {
        $this->publishes([
            $this->getConfigsPath() => config_path('nova-events.php'),
        ]);
    }

    /**
     * Grab the path to the config files
     *
     * @return void
     */
    private function getConfigsPath()
    {
        return __DIR__.'/../Config/nova-events.php';
    }

    /**
     * Register the artisan packages' terminal commands
     *
     * @return void
     */
    private function bootCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // MyCommand::class,
            ]);
        }
    }

    /**
     * Load custom views
     *
     * @return void
     */
    private function bootViews()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'dewsign');
        $this->publishes([
            __DIR__.'/../Resources/views' => resource_path('views/vendor/dewsign'),
        ]);
    }

    /**
     * Define publishable assets
     *
     * @return void
     */
    private function bootAssets()
    {
        $this->publishes([
            __DIR__.'/../Resources/assets/js' => resource_path('assets/js/vendor/dewsign'),
        ], 'js');
    }

    /**
     * Make middleware available to routes
     *
     * @param Router $router
     * @return void
     */
    private function registerMiddleware(Router $router)
    {
        // $router->aliasMiddleware('name', MyMiddleware::class);
    }

    private function publishDatabaseFiles()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(
            __DIR__ . '/../Database/factories'
        );

        $this->publishes([
            __DIR__ . '/../Database/factories' => base_path('database/factories')
        ], 'factories');

        $this->publishes([
            __DIR__ . '/../Database/migrations' => base_path('database/migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../Database/seeds' => base_path('database/seeds')
        ], 'seeds');
    }
}
