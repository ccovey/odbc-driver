<?php namespace Ccovey\ODBCDriver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database;

class ODBCDriverServiceProvider extends ServiceProvider {

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
		$this->package('ccovey/odbc-driver');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['db.factory'] = $this->app->share(function() {
			return new ODBCDriverConnectionFactory;
		});

		$this->app['db'] = $this->app->share(function($app) {
			return new Database\DatabaseManager($app, $app['db.factory']);
		});

		$this->registerEloquent();
	}

	public function registerEloquent()
	{
		Database\Eloquent\Model::setConnectionResolver($this->app['db']);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('odbcdriver');
	}

}