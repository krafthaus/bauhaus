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

use Closure;
use KraftHaus\Bauhaus\Mapper\BaseMapper;
use Illuminate\Support\Str;

/**
 * Class FormMapper
 * @package KraftHaus\Bauhaus\Mapper
 */
class FormMapper extends BaseMapper
{

	protected $tab = null;

	protected $position = 'left';

	/**
	 * Override the parent __call method for tab creation.
	 *
	 * @param  string $type
	 * @param  array  $arguments
	 *
	 * @access public
	 * @return mixed
	 */
	public function __call($type, array $arguments)
	{
		$name  = array_shift($arguments);
		$type  = sprintf('\\KraftHaus\\Bauhaus\\Field\\%sField', Str::studly($type));
		$field = new $type($name, $this->getAdmin());

		// Set default value
		if (isset($arguments[0])) {
			$field->setValue($arguments[0]);
		}

		$this->fields[$name] = $field;

		if ($this->getTab() !== null) {
			$field->setTab($this->tab);
		}

		$field->setPosition($this->getPosition());

		return $field;
	}

	/**
	 * Check if this mapper has tabs.
	 *
	 * @access public
	 * @return bool
	 */
	public function hasTabs()
	{
		return count($this->getTabs()) > 0;
	}

	/**
	 * Get the mapper tabs.
	 *
	 * @access public
	 * @return array
	 */
	public function getTabs()
	{
		$tabs = [];
		foreach ($this->getFields() as $field) {
			if ($field->getTab() === null) {
				continue;
			}

			$tabs[Str::slug($field->getTab())] = $field->getTab();
		}

		return $tabs;
	}

	/**
	 * Set the mapper current tab.
	 *
	 * @param  string          $name
	 * @param  string|callable $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function tab($name, $mapper)
	{
		$this->tab = $name;

		if ($mapper instanceof Closure) {
			$mapper($this);
		}
	}

	public function getTab()
	{
		return $this->tab;
	}

	/**
	 * Set the field position. (left|right).
	 * 
	 * @param  string  $position
	 * @param  Closure $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function position($position, Closure $mapper)
	{
		$this->position = $position;
		$mapper($this);
	}

	/**
	 * Get the field position.
	 *
	 * @access public
	 * @return string
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * Check for fields on a specific position.
	 *
	 * @param  string $position
	 *
	 * @access public
	 * @return bool
	 */
	public function hasFieldsOnPosition($position)
	{
		$fieldsOnPosition = false;

		foreach ($this->getFields() as $field) {
			if ($field->getPosition() == $position) {
				$fieldsOnPosition = true;
			}
		}

		return $fieldsOnPosition;
	}

}