<?php

namespace Bengels\LaravelTable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Bengels\LaravelTable\DataBinds\DataBinder;

/**
 * Class LaravelTableProvider
 *
 * @package Bengels\LaravelTableProvider
 */
class LaravelTableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		Blade::directive('bindData', function ($bind) {
			return '<?php app(DataBinder::class)->bind(' . $bind . '); ?>';
		});
		Blade::directive('endBindData', function () {
			return '<?php app(DataBinder::class)->pop(); ?>';
		});

        $this->loadViewsFrom(__DIR__.'/resources/views', 'LaravelTable');
        $this->publishes(
            [__DIR__.'/config/laravel-table.php' => config_path('laravel-table.php')],
            'config'
        );
        $this->publishes(
            [__DIR__.'/resources/views' => resource_path('views/vendor/laravel-table')],
            'views'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/laravel-table.php',
            'laravel-table'
        );
		$this->app->singleton(DataBinder::class, fn () => new DataBinder());
    }
}
