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
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ViewsGenerateCommand
 * @package KraftHaus\Bauhaus
 */
class ViewsGenerateCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'bauhaus:views:generate';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Generate clean views for custom backends.';

	/**
	 * Execute the console command.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fire()
	{
		$view  = $this->option('view');
		$model = $this->option('model');

		$path = app_path(sprintf('views/bauhaus/%s', $model));
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$stub = file_get_contents(__DIR__ . sprintf('/stubs/views/%s.txt', $view));
		$stub = str_replace('$NAME$', $model, $stub);
		file_put_contents(sprintf('%s/%s.blade.php', $path, $view), $stub);

		$this->info(sprintf('Views generated in %s`', $path));
	}

	/**
	 * Get the console command options.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['view',  null, InputOption::VALUE_REQUIRED, 'The view type.',null],
			['model', null, InputOption::VALUE_REQUIRED, 'The model.', null]
		];
	}

}
