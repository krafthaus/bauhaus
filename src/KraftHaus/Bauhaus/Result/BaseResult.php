<?php

namespace KraftHaus\Bauhaus\Result;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class BaseResult
{

	/**
	 * Holds the item identifier (normally the id).
	 * @var integer
	 */
	protected $identifier;

	/**
	 * Holds the resources fields.
	 * @var array
	 */
	protected $fields = [];

	/**
	 * Set the identifier.
	 * 
	 * @param  integer $identifier
	 *
	 * @access public
	 * @return BaseResult
	 */
	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
		return $this;
	}

	/**
	 * Get the identifier.
	 * 
	 * @access public
	 * @return integer
	 */
	public function getIdentifier()
	{
		return $this->identifier;
	}

	/**
	 * Add a field to the result.
	 * 
	 * @param  string $key
	 * @param  string field
	 *
	 * @access public
	 * @return BaseResult
	 */
	public function addField($key, $field)
	{
		$this->fields[$key] = $field;
		return $this;
	}

	/**
	 * Get the fields.
	 * 
	 * @access public
	 * @return array
	 */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * Get a field.
	 * 
	 * @access public
	 * @return string
	 */
	public function getField($key)
	{
		return $this->fields[$key];
	}

}