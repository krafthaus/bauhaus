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
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

/**
 * Class FileField
 * @package KraftHaus\Bauhaus\Field
 */
class FileField extends BaseField
{

	protected $location;
	protected $naming;
	protected $originalname;

	public function location($location)
	{
		$this->location = $location;
		return $this;
	}

	public function getLocation()
	{
		return $this->location;
	}

	public function naming($naming)
	{
		$this->naming = $naming;
		return $this;
	}

	public function getNaming()
	{
		return $this->naming;
	}

	public function setOriginalname($name)
	{
		$this->originalname = $name;
		return $this;
	}

	public function getOriginalName()
	{
		return $this->originalname;
	}

	public function preUpdate()
	{
		$formBuilder = $this->getAdmin()->getFormBuilder();
		$tempName    = $this->getName();

		if (Input::hasFile($this->getName())) {
			$file = Input::file($this->getName());
			$this->setOriginalname($file->getClientOriginalName());

			$name = $file->getClientOriginalName();
			$name = $this->handleNaming($name, $file->getClientOriginalExtension());
			$this->setName($name);

			$file->move($this->getLocation(), $name);

			$value = sprintf('%s/%s', $this->getLocation(), $name);
			$formBuilder->setInputVariable($tempName, $value);
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

	protected function handleNaming($name, $extention = null)
	{
		switch ($this->getNaming()) {
			case 'original':
				return $name;
			case 'random':
				$name = Str::random();
				
				if ($extention !== null) {
					$name = sprintf('%s.%s', $name, $extention);
				}

				return strtolower($name);
		}
		
		return $name;
	}

}
