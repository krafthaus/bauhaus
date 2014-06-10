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
use Carbon\Carbon;

/**
 * Class TimeField
 * @package KraftHaus\Bauhaus\Field
 */
class TimeField extends BaseField
{

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		$format = Config::get('bauhaus::admin.date_format.time');

		if ($this->getValue() instanceof Carbon) {
			$value = $this->getValue()->format($format);
		} else {
			$value = date($format, strtotime($this->getValue()));
		}

		$this->setValue($value);

		return View::make('krafthaus/bauhaus::models.fields._time')
			->with('field', $this);
	}

}