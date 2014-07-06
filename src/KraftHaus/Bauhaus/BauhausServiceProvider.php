<?php

namespace KraftHaus\Bauhaus;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Menu\Builder as MenuBuilder;
use KraftHaus\Bauhaus\Block\Builder as BlockBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;

/**
 * Class BauhausServiceProvider
 * @package KraftHaus\Bauhaus
 */
class BauhausServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the package.
	 * 
	 * @access public
	 * @return void
	 */
	public function boot()
	{
		$this->package('krafthaus/bauhaus');
		View::addNamespace('krafthaus/bauhaus', __DIR__ . '/../../views/');

		// Register the menu builder
		App::singleton('krafthaus.bauhaus.menu', function () {
			return new MenuBuilder;
		});

		// Register the block builder
		App::singleton('krafthaus.bauhaus.block', function () {
			return new BlockBuilder;
		});

		require_once __DIR__ . '/../../filters.php';
		require_once __DIR__ . '/../../routes.php';
		require_once __DIR__ . '/../../composers.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @access public
	 * @return void
	 */
	public function register()
	{
		// add the install command to the application
		$this->app['bauhaus:scaffold'] = $this->app->share(function($app) {
			return new ScaffoldCommand($app);
		});

		// add the export views command to the application
		$this->app['bauhaus:export:views'] = $this->app->share(function ($app) {
			return new ExportViewsCommand($app);
		});

		$this->commands('bauhaus:scaffold');
		$this->commands('bauhaus:export:views');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @access public
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
