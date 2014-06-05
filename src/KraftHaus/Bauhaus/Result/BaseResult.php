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

	protected $identifier;
	protected $fields = [];

	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
		return $this;
	}

	public function getIdentifier()
	{
		return $this->identifier;
	}

	public function addField($key, $field)
	{
		$this->fields[$key] = $field;
		return $this;
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function getField($key)
	{
		return $this->fields[$key];
	}

}