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

	public function build($position)
	{
		$items = [];

		if (isset($this->items[$position])) {
			foreach ($this->items[$position] as $key => $item) {
				$type = array_shift($item);
				$items[$key] = new $type($item);
			}
		}

		return $items;
	}

	public static function render($position)
	{
		$self  = new self;
		$items = $self->build($position);

		$render = '';
		foreach ($items as $item) {
			$render.= $item->render();
		}

		return $render;
	}

}