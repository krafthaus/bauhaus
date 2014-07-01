<?php

namespace KraftHaus\Bauhaus\Field;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Closure;
use Illuminate\Support\Str;

/**
 * Class BaseField
 * @package KraftHaus\Bauhaus\Field
 * @abstract
 */
abstract class BaseField
{

	const CONTEXT_LIST = 'list';
	const CONTEXT_FORM = 'form';
	const CONTEXT_FILTER = 'filter';

	/**
	 * Holds the current admin instance.
	 * @var \KraftHaus\Bauhaus\Admin
	 */
	protected $admin;

	/**
	 * Holds the field context.
	 * @var string
	 */
	protected $context;

	/**
	 * Holds the row id.
	 * @var int
	 */
	protected $rowId;

	/**
	 * Holds the field name.
	 * @var string
	 */
	protected $name;

	/**
	 * Holds the field value.
	 * @var string
	 */
	protected $value;

	/**
	 * Holds the field label.
	 * @var null|string
	 */
	protected $label = null;

	/**
	 * Holds the field description.
	 * @var null|string
	 */
	protected $description = null;

	/**
	 * Holds the field placeholder.
	 * @var null|string
	 */
	protected $placeholder = null;

	/**
	 * Holds the field attributes.
	 * @var array
	 */
	protected $attributes = [
		'class' => 'form-control'
	];

	/**
	 * Holds the field tab name.
	 * @var null|string
	 */
	protected $tab = null;

	/**
	 * Holds the field position (left|right).
	 * @var string
	 */
	protected $position = 'left';

	/**
	 * Holds the field before filter.
	 * @var null|callable
	 */
	protected $before = null;

	/**
	 * Holds the field after filter.
	 * @var null|callable
	 */
	protected $after = null;

	protected $saving = null;

	/**
	 * Abstract function for rendering the fields.
	 *
	 * @access public
	 * @return mixed
	 * @abstract
	 */
	abstract public function render();

	/**
	 * Public class constructor.
	 *
	 * @param  $name
	 *
	 * @access public
	 * @return void
	 */
	public function __construct($name, $admin)
	{
		$this->setName($name);
		$this->setAdmin($admin);
	}

	public function preUpdate()
	{
		// intentionally left black
	}

	public function postUpdate($input)
	{
		// intentionally left blank
	}

	/**
	 * Set the current admin instance.
	 *
	 * @param  \KraftHaus\Bauhaus\Admin $admin
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setAdmin($admin)
	{
		$this->admin = $admin;
		return $this;
	}

	/**
	 * Get the current admin instance.
	 *
	 * @access public
	 * @return \KraftHaus\Bauhaus\Admin
	 */
	public function getAdmin()
	{
		return $this->admin;
	}

	/**
	 * Set the row id.
	 *
	 * @param  int $rowId
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setRowId($rowId)
	{
		$this->rowId = $rowId;
		return $this;
	}

	/**
	 * Get the row id.
	 *
	 * @access public
	 * @return int
	 */
	public function getRowId()
	{
		return $this->rowId;
	}

	/**
	 * Set the field context.
	 *
	 * @param  string $context
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setContext($context)
	{
		$this->context = $context;
		return $this;
	}

	/**
	 * Get the field context.
	 *
	 * @access public
	 * @return string
	 */
	public function getContext()
	{
		return $this->context;
	}

	/**
	 * Set the field name.
	 *
	 * @param  string $name
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * Get the field name.
	 *
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the field value.
	 *
	 * @param  string $value
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Get the field value.
	 *
	 * @access public
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set the field label.
	 *
	 * @param  string $label
	 *
	 * @access public
	 * @return BaseField
	 */
	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * Get the field label.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getLabel()
	{
		if ($this->label === null) {
			return Str::title($this->getName());
		}

		return $this->label;
	}

	/**
	 * Set the field description.
	 *
	 * @param  string $description
	 *
	 * @access public
	 * @return BaseField
	 */
	public function description($description)
	{
		$this->description = $description;
		return $this;
	}

	/**
	 * Get the field description.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set the field placeholder.
	 *
	 * @param  string $placeholder
	 *
	 * @access public
	 * @return BaseField
	 */
	public function placeholder($placeholder)
	{
		return $this->attribute('placeholder', $placeholder);
	}

	/**
	 * Get the field placeholder.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getPlaceholder()
	{
		return $this->placeholder;
	}

	/**
	 * Set an attribute on this field.
	 * Like class or id.
	 *
	 * @param  string $attribute
	 * @param  string $value
	 *
	 * @access public
	 * @return BaseField
	 */
	public function attribute($attribute, $value)
	{
		$this->attributes[$attribute] = (string) $value;
		return $this;
	}

	/**
	 * Check if a given attribute is set on this field.
	 *
	 * @param  string $attribute
	 *
	 * @access public
	 * @return bool
	 */
	public function hasAttribute($attribute)
	{
		return isset($this->attributes[$attribute]);
	}

	/**
	 * Get a given attribute for this field.
	 *
	 * @param  string $attribute
	 *
	 * @access public
	 * @return mixed
	 */
	public function getAttribute($attribute)
	{
		return $this->attributes[$attribute];
	}

	/**
	 * Return all the field attributes.
	 *
	 * @access public
	 * @return array
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}

	/**
	 * Set the field tab.
	 *
	 * @param  string $tab
	 *
	 * @access public
	 * @return $this
	 */
	public function setTab($tab)
	{
		$this->tab = $tab;
		return $this;
	}

	/**
	 * Get the field tab.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getTab()
	{
		return $this->tab;
	}

	/**
	 * Set the field position.
	 * 
	 * @param  string $position
	 *
	 * @access public
	 * @return BaseField
	 */
	public function setPosition($position)
	{
		$this->position = $position;
		return $this;
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
	 * Execute a before filter on the field value.
	 *
	 * @param  mixed $callback
	 *
	 * @access public
	 * @return BaseField
	 */
	public function before($callback)
	{
		$this->before = $callback;
		return $this;
	}

	/**
	 * Check if this field has a before filter.
	 *
	 * @access public
	 * @return bool
	 */
	public function hasBefore()
	{
		return $this->before !== null;
	}

	/**
	 * Get the before filter.
	 *
	 * @access public
	 * @return callable|null
	 */
	public function getBefore()
	{
		return $this->before;
	}

	public function saving(Closure $callback)
	{
		$this->saving = $callback;
		return $this;
	}

	public function hasSaving()
	{
		return $this->saving !== null;
	}

	public function getSaving()
	{
		return $this->saving;
	}

}