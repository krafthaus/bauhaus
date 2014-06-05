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
use Illuminate\Support\Facades\Input;

/**
 * Class BooleanField
 * @package KraftHaus\Bauhaus\Field
 */
class BooleanField extends BaseField
{

	protected $inlineRender = true;

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make('krafthaus/bauhaus::models.fields._boolean')
			->with('field', $this);
	}

	public function preUpdate()
	{
		$formBuilder = $this->getAdmin()->getFormBuilder();

		if (!Input::has($this->getName())) {
			$formBuilder->setInputVariable($this->getName(), 0);
		}
	}

}