<?php

namespace KraftHaus\Bauhaus\Export\Format;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

abstract class BaseFormat
{

	/**
	 * Holds the ListBuilder object.
	 * @var \KraftHaus\Bauhaus\Builder\ListBuilder
	 */
	protected $listBuilder;

	/**
	 * Create a new export based on the ListBuilder object.
	 *
	 * @return mixed
	 * @abstract
	 */
	abstract public function export();

	/**
	 * Set the ListBuilder instance.
	 *
	 * @param  \KraftHaus\Bauhaus\Builder $listBuilder
	 *
	 * @access public
	 * @return Builder
	 */
	public function setListBuilder($listBuilder)
	{
		$this->listBuilder = $listBuilder;
		return $this;
	}

	/**
	 * Get the ListBuilder object.
	 *
	 * @access public
	 * @return \KraftHaus\Bauhaus\Builder\ListBuilder
	 */
	public function getListBuilder()
	{
		return $this->listBuilder;
	}

}