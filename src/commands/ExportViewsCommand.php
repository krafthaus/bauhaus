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
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * Class ExportViewsCommand
 * @package KraftHaus\Bauhaus
 */
class ExportViewsCommand extends Command
{

	/**
	 * The console command name.
	 * @var string
	 */
	protected $name = 'bauhaus:export:views';

	/**
	 * The console command description.
	 * @var string
	 */
	protected $description = 'Export all bauhaus views to the app folder.';

	/**
	 * Execute the console command.
	 *
	 * @access public
	 * @return mixed
	 */
	public function fire()
	{
		$source      = realpath(__DIR__ . '/../views');
		$destination = app_path('views/bauhaus');
		
		File::copyDirectory($source, $destination);

		$this->info(sprintf('Views exported to `%s`', $destination));
	}

}