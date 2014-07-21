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
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\View;

/**
 * Class WysiwygField
 * @package KraftHaus\Bauhaus\Field
 */
class WysiwygField extends BaseField
{

	protected $view = 'krafthaus/bauhaus::models.fields._wysiwyg';

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

	/**
	 * Override the getAttributes method to add the multiple attribute.
	 *
	 * @access public
	 * @return array
	 */
	public function getAttributes()
	{
		$this->attribute('class', 'form-wysiwyg');
		return $this->attributes;
	}

}