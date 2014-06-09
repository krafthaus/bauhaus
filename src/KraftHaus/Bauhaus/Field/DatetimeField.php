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
 * Class DatetimeField
 * @package KraftHaus\Bauhaus\Field
 */
class DatetimeField extends BaseField
{

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		if ($this->getValue() instanceof Carbon) {
			$value = $this->getValue()->format('Y:m:d H:i:s');
		} else {
			$value = date('Y:m:d H:i:s', strtotime($this->getValue()));
		}

		$this->setValue($value);

		return View::make('krafthaus/bauhaus::models.fields._datetime')
			->with('field', $this);
	}

}