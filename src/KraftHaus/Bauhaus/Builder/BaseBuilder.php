<?php

namespace KraftHaus\Bauhaus\Builder;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Mapper\ListMapper;

/**
 * Class BaseBuilder
 * @package KraftHaus\Bauhaus\Builder
 * @abstract
 */
abstract class BaseBuilder
{

	/**
	 * Holds the mapper object.
	 * @var ListMapper
	 */
	protected $mapper;

	/**
	 * Holds the model name.
	 * @var string
	 */
	protected $model;

	/**
	 * Holds the input.
	 * @var Input
	 */
	protected $input;

	/**
	 * The abstract function for building data in the parent builders.
	 *
	 * @access public
	 * @return mixed
	 * @abstract
	 */
	abstract public function build();

	/**
	 * Public class constructor.
	 *
	 * @param  mixed $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function __construct($mapper)
	{
		$this->setMapper($mapper);
	}

	/**
	 * Set the mapper object.
	 *
	 * @param  mixed $mapper
	 *
	 * @access public
	 * @return BaseBuilder
	 */
	public function setMapper($mapper)
	{
		$this->mapper = $mapper;
		return $this;
	}

	/**
	 * Get the mapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getMapper()
	{
		return $this->mapper;
	}

	/**
	 * Set the model name.
	 *
	 * @param  string $model
	 *
	 * @access public
	 * @return BaseBuilder
	 */
	public function setModel($model)
	{
		$this->model = $model;
		return $this;
	}

	/**
	 * Get the model name.
	 *
	 * @access public
	 * @return string
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Set the input for the builder from the Laravel input object.
	 * 
	 * @param  array $input
	 *
	 * @access public
	 * @return BaseBuilder
	 */
	public function setInput($input)
	{
		$this->input = $input;
		return $this;
	}

	/**
	 * Get the input array.
	 *
	 * @access public
	 * @return array
	 */
	public function getInput()
	{
		return $this->input;
	}

	/**
	 * Set an specific input variable.
	 * 
	 * @param  string $key
	 * @param  mixed  $value
	 *
	 * @access public
	 * @return BaseBuilder
	 */
	public function setInputVariable($key, $value)
	{
		$this->input[$key] = $value;
		return $this;
	}

	/**
	 * Get a specific input variable.
	 * 
	 * @param  string $key
	 *
	 * @access public
	 * @return mixed
	 */
	public function getInputVariable($key)
	{
		return $this->input[$key];
	}

	/**
	 * Unset a specific input variable.
	 * 
	 * @param  string $key
	 *
	 * @access public
	 * @return BaseBuilder
	 */
	public function unsetInputVariable($key)
	{
		unset($this->input[$key]);
		return $this;
	}

}