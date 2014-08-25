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

use Orchestra\Testbench\TestCase;

/**
 * Class StringFieldTest
 * @package KraftHaus\Bauhaus\Tests
 */
class StringFieldTest extends TestCase implements FieldInterface
{

	public function testAddToListMapper()
	{
		// can add to list mapper
		$this->assertTrue(true);
	}

	public function testAddToFormMapper()
	{
		// cannot add to form mapper
		$this->assertFalse(false);
	}

	public function testAddToFilterMapper()
	{
		// cannot add to filter mapper
		$this->assertFalse(false);
	}

	public function testAddToScopeMapper()
	{
		// cannot add to scope mapper
		$this->assertFalse(false);
	}

}