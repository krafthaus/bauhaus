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
 * Class NumberField
 * @package KraftHaus\Bauhaus\Field
 */
class NumberField extends BaseField
{

	/**
	 * Holds the number of decimals.
	 * @var int
	 */
	protected $decimals = 2;

	/**
	 * Holds the number separators.
	 * [0] = decimal point
	 * [1] = thousands separator
	 *
	 * @var array
	 */
	protected $separators = ['.', '.'];

	/**
	 * Set the number of decimals.
	 *
	 * @param  int $decimals
	 *
	 * @access public
	 * @return NumberField
	 */
	public function decimals($decimals)
	{
		$this->decimals = $decimals;
		return $this;
	}

	/**
	 * Get the number of decimals.
	 *
	 * @access public
	 * @return int
	 */
	public function getDecimals()
	{
		return $this->decimals;
	}

	/**
	 * Set the number separators.
	 *
	 * @param  array $separators
	 *
	 * @access public
	 * @return NumberField
	 */
	public function separators(array $separators)
	{
		$this->separators = $separators;
		return $this;
	}

	/**
	 * Get the number separators.
	 *
	 * @access public
	 * @return array
	 */
	public function getSeparators()
	{
		return $this->separators;
	}

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		$separators = $this->getSeparators();
		$this->setValue(number_format($this->getValue(), $this->getDecimals(), $separators[0], $separators[1]));

		return View::make('krafthaus/bauhaus::models.fields._number')
			->with('field', $this);
	}

}