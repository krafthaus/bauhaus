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
	 * Test that a menu instance can be created.
	 *
	 * @access public
	 * @return void
	 */
	public function testCreateInstance()
	{
		$builder = new Builder;
		$this->assertTrue(get_class($builder) == 'KraftHaus\Bauhaus\Menu\Builder');
	}

	/**
	 * Test that a menu item can be created.
	 *
	 * @access public
	 * @return void
	 */
	public function testCreateMenuItem()
	{
		$builder = (new Builder)->addMenu('left', [
			'title' => 'Menu Item',
			'class' => 'Item'
		]);

		$this->assertArrayHasKey('left',    $builder->getItems());
		$this->assertArrayHasKey('title',   $builder->getItems()['left'][0]);
		$this->assertArrayHasKey('class',   $builder->getItems()['left'][0]);
		$this->assertArrayNotHasKey('icon', $builder->getItems()['left'][0]);
	}

	/**
	 * Test that a menu item can be created on the right position.
	 *
	 * @access public
	 * @return void
	 */
	public function testCreateMenuItemWithPosition()
	{
		$builder = (new Builder)->addMenu('right', [
			'title' => 'Menu Item',
			'class' => 'Item'
		]);

		$this->assertArrayHasKey('right', $builder->getItems());
	}

	/**
	 * Test that a menu item can have children.
	 *
	 * @access public
	 * @return void
	 */
	public function testCreateMenuItemWithDropdown()
	{
		$builder = (new Builder)->addMenu('left', [
			'title' => 'Menu Item',
			'children' => [
				[
					'title' => 'Sub item',
					'class' => 'Sub'
				]
			]
		]);

		$this->assertArrayHasKey('children', $builder->getItems()['left'][0]);
		$this->assertEquals([
			'title' => 'Sub item',
			'class' => 'Sub'
		], $builder->getItems()['left'][0]['children'][0]);
	}

	/**
	 * Test that a menu item can have an icon.
	 *
	 * @access public
	 * @return void
	 */
	public function testCreateMenuItemWithIcon()
	{
		$builder = (new Builder)->addMenu('left', [
			'title' => 'Menu Item',
			'class' => 'Item',
			'icon'  => 'code'
		]);

		$this->assertArrayHasKey('icon', $builder->getItems()['left'][0]);
		$this->assertEquals('code', $builder->getItems()['left'][0]['icon']);
	}

}