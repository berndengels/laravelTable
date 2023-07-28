<?php

namespace Bengels\LaravelTable;

use Bengels\LaravelTable\Component\Button\ShowButton;
use Bengels\LaravelTable\Components\Table\Td;
use Bengels\LaravelTable\Components\Table\Table;
use Bengels\LaravelTable\Components\Table\Action;
use Illuminate\Foundation\Console\AboutCommand;
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
		AboutCommand::add('My Package', fn () => ['Version' => '1.0.0']);

		Blade::components([
			'table'         => Table::class,
			'td'            => Td::class,
			'action'        => Action::class,
			'btn-edit'      => EditButton::class,
			'btn-delete'    => DeleteButton::class,
			'btn-show'   	=> ShowButton::class,
		]);

		Blade::directive('bindData', function ($bind) {
			return '<?php app(DataBinder::class)->bind(' . $bind . '); ?>';
		});
		Blade::directive('endBindData', function () {
			return '<?php app(DataBinder::class)->pop(); ?>';
		});

        $this->loadViewsFrom(__DIR__.'/resources/views', 'table-components');

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
