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
use Illuminate\Support\Facades\Input;

/**
 * Class FileField
 * @package KraftHaus\Bauhaus\Field
 */
class FileField extends BaseField
{

	protected $location;

	public function location($location)
	{
		$this->location = $location;
		return $this;
	}

	public function getLocation()
	{
		return $this->location;
	}

	public function preUpdate()
	{
		$formBuilder = $this->getAdmin()->getFormBuilder();

		if (Input::hasFile($this->getName())) {
			$file = Input::file($this->getName());
			$name = $file->getClientOriginalName();

			$file->move($this->getLocation(), $name);

			$value = sprintf('%s/%s', $this->getLocation(), $name);
			$formBuilder->setInputVariable($this->getName(), $value);
		} else {
			$formBuilder->unsetInputVariable($this->getName());
		}
	}

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make('krafthaus/bauhaus::models.fields._file')
			->with('field', $this);
	}

}