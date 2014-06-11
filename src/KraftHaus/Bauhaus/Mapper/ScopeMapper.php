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

use KraftHaus\Bauhaus\Mapper\BaseMapper;
use KraftHaus\Bauhaus\Scope\Scope;

/**
 * Class ScopeMapper
 * @package KraftHaus\Bauhaus\Mapper
 */
class ScopeMapper extends BaseMapper
{

	/**
	 * Holds the list of scopes.
	 * @var array
	 */
	protected $scopes = [];

	/**
	 * Add a scope.
	 *
	 * @param  string $scope
	 *
	 * @access public
	 * @return ScopeMapper
	 */
	public function scope($scope)
	{
		$scope = (new Scope())->scope($scope);

		$this->scopes[] = $scope;
		return $scope;
	}

	public function hasScopes()
	{
		return count($this->scopes) > 0;
	}

	/**
	 * Get the array of scopes.
	 *
	 * @access public
	 * @return array
	 */
	public function getScopes()
	{
		return $this->scopes;
	}

}