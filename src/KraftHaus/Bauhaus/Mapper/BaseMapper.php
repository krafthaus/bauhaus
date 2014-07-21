<?php

namespace KraftHaus\Bauhaus\Mapper;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Str;

class BaseMapper
{

	/**
	 * Holds the admin instance.
	 * @var Admin
	 */
	protected $admin;

	/**
	 * Holds the mapper fields.
	 * @var array
	 */
	protected $fields = [];

	/**
	 * "magic" caller method to simply instantiate field types.
	 * 
	 * @param  string $type
	 * @param  array  $arguments
	 *
	 * @access public
	 * @return BaseField
	 */
	public function __call($type, array $arguments)
	{
		$name  = array_shift($arguments);
		$type  = sprintf('\\KraftHaus\\Bauhaus\\Field\\%sField', Str::studly($type));
		$field = new $type($name, $this->getAdmin());

		$this->fields[$name] = $field;

		return $field;
	}

	/**
	 * Set the Admin object.
	 * 
	 * @param  Admin $admin
	 *
	 * @access public
	 * @return void
	 */
	public function setAdmin($admin)
	{
		$this->admin = $admin;
		return $this;
	}

	/**
	 * Get the Admin object.
	 *
	 * @access public
	 * @return Admin
	 */
	public function getAdmin()
	{
		return $this->admin;
	}

	/**
	 * Get the fields array.
	 *
	 * @access public
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * Get a specific field.
	 * 
	 * @param  string $field
	 *
	 * @access public
	 * @return Field
	 */
	public function getField($field)
	{
		return $this->fields[$field];
	}

	/**
	 * Check if the object has a specific field.
	 * 
	 * @param  string $field
	 *
	 * @access public
	 * @return boolean
	 */
	public function hasField($field)
	{
		return isset($this->fields[$field]);
	}

}