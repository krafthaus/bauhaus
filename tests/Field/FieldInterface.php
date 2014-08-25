<?php

namespace KraftHaus\Bauhaus\Tests;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Interface FieldInterface
 * @package KraftHaus\Bauhaus\Tests
 */
interface FieldInterface
{

	/**
	 * Test adding this field to the list mapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function testAddToListMapper();

	/**
	 * Test adding this field to the form mapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function testAddToFormMapper();

	/**
	 * Test adding this field to the filter mapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function testAddToFilterMapper();

	/**
	 * Test adding this field to the scope mapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function testAddToScopeMapper();

}