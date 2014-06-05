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

use Illuminate\Support\Facades\View;
use KraftHaus\Bauhaus\Field\StringField;

/**
 * Class StringField
 * @package KraftHaus\Bauhaus\Field
 */
class IdentifierField extends StringField
{

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make('krafthaus/bauhaus::models.fields._identifier')
			->with('model', $this->getAdmin()->getModel())
			->with('row',   $this->getRowId())
			->with('value', $this->getValue());
	}

}