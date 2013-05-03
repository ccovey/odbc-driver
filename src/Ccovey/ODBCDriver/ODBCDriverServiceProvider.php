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
		Database\Eloquent\Model::setConnectionResolver($this->app['db']);

		Database\Eloquent\Model::setEventDispatcher($this->app['events']);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['db.factory'] = $this->app->share(function($app) {
			return new ODBCDriverConnectionFactory($app);
		});

		$this->app['db'] = $this->app->share(function($app) {
			return new Database\DatabaseManager($app, $app['db.factory']);
		});
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