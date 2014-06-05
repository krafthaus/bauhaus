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

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class ScaffoldCommand
 * @package KraftHaus\Bauhaus
 */
class ScaffoldCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'bauhaus:scaffold';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = '';

	/**
	 * Execute the console command.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fire()
	{
		$model = $this->option('model');
		$plural = Str::plural($model);

		// Create the migration
		$this->call('migrate:make', [
			'name'     => sprintf('create_%s_table', $plural),
			'--table'  => $plural,
			'--create' => true
		]);

		// Create the model
		$stub = file_get_contents(__DIR__ . '/stubs/model.txt');
		$stub = str_replace('$NAME$', Str::studly($model), $stub);
		file_put_contents(app_path('models/' . ucfirst($model) . '.php'), $stub);

		// Create the admin controller
		$stub = file_get_contents(__DIR__ . '/stubs/admin.txt');
		$stub = str_replace('$NAME$', Str::studly($model), $stub);
		file_put_contents(app_path('admin/' . ucfirst($model) . 'Admin.php'), $stub);
	}

	/**
	 * Get the console command options.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getOptions()
	{
		return [['model', null, InputOption::VALUE_REQUIRED, 'An example option.', null]];
	}

}