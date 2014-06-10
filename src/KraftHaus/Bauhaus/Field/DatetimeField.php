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
use Illuminate\Support\Facades\Config;

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
		$format = Config::get('bauhaus::admin.date_format.datetime');

		if ($this->getValue() instanceof Carbon) {
			$value = $this->getValue()->format($format);
		} else {
			$value = date($format, strtotime($this->getValue()));
		}

		$this->setValue($value);

		return View::make('krafthaus/bauhaus::models.fields._datetime')
			->with('field', $this);
	}

}