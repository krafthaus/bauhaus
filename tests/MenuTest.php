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
use KraftHaus\Bauhaus\Menu\Builder;

/**
 * Class MenuTest
 * @package KraftHaus\Bauhaus\Tests
 */
class MenuTest extends TestCase
{

	/**
	 *
	 */
	public function testCreateInstance()
	{
		$builder = new Builder;
		$this->assertTrue(get_class($builder) == 'KraftHaus\Bauhaus\Menu\Builder');
	}

	/**
	 *
	 */
	public function testCreateMenuItem()
	{
		$builder = new Builder;
		$builder->addMenu('left', [
			'title' => 'Menu Item',
			'class' => 'Test'
		]);

		print_r($builder);

		$this->assertFalse(false);
	}

	public function testCreateMenuItemWithPosition()
	{
		$this->assertFalse(false);
	}

	public function testCreateMenuItemWithDropdown()
	{
		$this->assertFalse(false);
	}

	public function testCreateMenuItemWithIcon()
	{
		$this->assertFalse(false);
	}

	public function testCreateMenuItemWithNamespace()
	{
		$this->assertFalse(false);
	}

}