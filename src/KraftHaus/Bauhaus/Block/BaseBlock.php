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

/**
 * Class BaseBlock
 * @package KraftHaus\Bauhaus\Block
 * @abstract
 */
abstract class BaseBlock
{

	/**
	 * Public class constructor.
	 *
	 * @param  array $arguments
	 *
	 * @access public
	 * @return void
	 */
	public function __construct(array $arguments = [])
	{
		$this->setArguments($arguments);
	}

	/**
	 * Abstract method for rendering the blocks.
	 *
	 * @access public
	 * @return mixed
	 * @abstract
	 */
	abstract public function render();

	/**
	 * Set the block arguments.
	 *
	 * @param  array $arguments
	 *
	 * @access public
	 * @return BaseBlock
	 */
	public function setArguments(array $arguments)
	{
		$this->arguments = $arguments;
		return $this;
	}

	/**
	 * Get the block arguments.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 * Check if a given argument is set.
	 *
	 * @param  string $argument
	 *
	 * @access public
	 * @return bool
	 */
	public function hasArgument($argument)
	{
		return isset($this->arguments[$argument]);
	}

	/**
	 * Get a specific argument.
	 *
	 * @param  string $argument
	 *
	 * @access public
	 * @return mixed
	 */
	public function getArgument($argument)
	{
		return $this->arguments[$argument];
	}
	
}