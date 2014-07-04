<?php

namespace KraftHaus\Bauhaus\Export;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Builder
 * @package KraftHaus\Bauhaus\Export
 */
class Builder
{

	/**
	 * Holds the ListBuilder object.
	 * @var \KraftHaus\Bauhaus\Builder\ListBuilder
	 */
	protected $listBuilder;

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

	/**
	 * Create a new export based on the ListBuilder output.
	 *
	 * @param  string $type
	 *
	 * @access public
	 * @return mixed
	 */
	public function export($type)
	{
		$format = sprintf('\\KraftHaus\\Bauhaus\\Export\\Format\\%sFormat', ucfirst($type));
		return (new $format)
			->setListBuilder($this->getListBuilder())
			->export();
	}

}