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
		if ($this->getValue() instanceof Carbon) {
			$value = $this->getValue()->format('H:i:s');
		} else {
			$value = date('H:i:s', strtotime($this->getValue()));
		}

		$this->setValue($value);

		return View::make('krafthaus/bauhaus::models.fields._time')
			->with('field', $this);
	}

}