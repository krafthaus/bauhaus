<?php

namespace KraftHaus\Bauhaus\Block;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Config;

/**
 * Class Builder
 * @package KraftHaus\Bauhaus\Block
 */
class Builder
{

	/**
	 * Holds the dashboard items.
	 * @var array
	 */
	protected $items = [];

	/**
	 * Public class constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->items = Config::get('bauhaus::admin.dashboard');
	}

	public function build()
	{
		foreach ($this->items as $key => $item) {
			$type = array_shift($item);
			$this->items[$key] = new $type($item);
		}

		return $this->items;
	}

}