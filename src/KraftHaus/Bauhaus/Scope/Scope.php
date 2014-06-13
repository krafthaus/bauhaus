<?php

namespace KraftHaus\Bauhaus\Scope;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class Scope
 * @package KraftHaus\Bauhaus\Scope
 */
class Scope
{

	/**
	 * Holds the scope label.
	 * @var string
	 */
	protected $label;

	/**
	 * Holds the scope method.
	 * @var string
	 */
	protected $scope;

	/**
	 * Set the scope label.
	 *
	 * @param  string $label
	 *
	 * @access public
	 * @return Scope
	 */
	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Get the scope label.
	 *
	 * @access public
	 * @return string
	 */
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Set the scope method.
	 *
	 * @param  string $scope
	 *
	 * @access public
	 * @return Scope
	 */
	public function scope($scope)
	{
		$this->scope = $scope;
		return $this;
	}

	/**
	 * Get the scope method.
	 *
	 * @access public
	 * @return string
	 */
	public function getScope()
	{
		return $this->scope;
	}

}