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

	public function setInput($input)
	{
		$this->input = $input;
		return $this;
	}

	public function getInput()
	{
		return $this->input;
	}

	public function setInputVariable($key, $value)
	{
		$this->input[$key] = $value;
		return $this;
	}

	public function getInputVariable($key)
	{
		return $this->input[$key];
	}

	public function unsetInputVariable($key)
	{
		unset($this->input[$key]);
		return $this;
	}

}