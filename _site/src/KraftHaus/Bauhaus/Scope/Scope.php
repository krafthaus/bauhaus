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

class Scope
{

	protected $label;
	protected $scope;

	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function scope($scope)
	{
		$this->scope = $scope;
		return $this;
	}

	public function getScope()
	{
		return $this->scope;
	}

}