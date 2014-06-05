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

/**
 * Class SelectField
 * @package KraftHaus\Bauhaus\Field
 */
class SelectField extends BaseField
{

	protected $view = 'krafthaus/bauhaus::models.fields._select';

	/**
	 * Holds the select options.
	 * @var array
	 */
	protected $options = [];

	/**
	 * Set the select options.
	 *
	 * @param  array $options
	 *
	 * @access public
	 * @return SelectField
	 */
	public function options(array $options)
	{
		$this->options = $options;
		return $this;
	}

	/**
	 * Get the select options
	 *
	 * @access public
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make($this->view)
			->with('field', $this);
	}

}