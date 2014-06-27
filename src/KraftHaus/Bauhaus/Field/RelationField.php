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

use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;

/**
 * Class BelongsToField
 * @package KraftHaus\Bauhaus\Field
 * @abstract
 */
abstract class RelationField extends BaseField
{

	/**
	 * Holds the display field name.
	 * @var string
	 */
	protected $displayField = null;

	/**
	 * Whether or not to render actions next to this field.
	 * @var bool
	 */
	protected $inline = true;

	/**
	 * Set the display field name.
	 *
	 * @param  string $displayField
	 *
	 * @access public
	 * @return BelongsToField
	 */
	public function display($displayField)
	{
		$this->displayField = $displayField;
		return $this;
	}

	/**
	 * Get the display field name.
	 *
	 * @access public
	 * @return string
	 */
	public function getDisplayField()
	{
		return $this->displayField;
	}

	/**
	 * Set inline rendering.
	 *
	 * @param  boolean $inline
	 *
	 * @access public
	 * @return BelongsToField
	 */
	public function setInline($inline)
	{
		$this->inline = (bool) $inline;
		return $this;
	}

	/**
	 * Get inline rendering.
	 *
	 * @access public
	 * @return BelongsToField
	 */
	public function getInline()
	{
		return $this;
	}

}