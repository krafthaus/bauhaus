<?php

namespace KraftHaus\Bauhaus\Facade;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Facade;

/**
 * Class Bauhaus
 * @package KraftHaus\Bauhaus\Facade
 */
class Bauhaus extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'KraftHaus\\Bauhaus\\Admin';
	}

}