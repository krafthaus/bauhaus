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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

/**
 * Class FileField
 * @package KraftHaus\Bauhaus\Field
 */
class FileField extends BaseField
{

	/**
	 * Holds the file location.
	 * @var string
	 */
	protected $location;

	/**
	 * Holds the file naming strategy.
	 * @var string
	 */
	protected $naming;

	/**
	 * Holds the temporary original name.
	 * @var string
	 */
	protected $originalname;

	/**
	 * Sets the file location.
	 *
	 * @param  string $location
	 *
	 * @access public
	 * @return $this
	 */
	public function location($location)
	{
		$this->location = $location;
		return $this;
	}

	/**
	 * Get the file location.
	 *
	 * @access public
	 * @return string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Set the file naming strategy.
	 *
	 * @param  string $naming
	 *
	 * @access public
	 * @return $this
	 */
	public function naming($naming)
	{
		$this->naming = $naming;
		return $this;
	}

	/**
	 * Get the file naming strategy.
	 *
	 * @access public
	 * @return string
	 */
	public function getNaming()
	{
		return $this->naming;
	}

	/**
	 * Set the original file name.
	 *
	 * @param  string $name
	 *
	 * @access public
	 * @return $this
	 */
	public function setOriginalname($name)
	{
		$this->originalname = $name;
		return $this;
	}

	/**
	 * Get the original file name.
	 *
	 * @access public
	 * @return string
	 */
	public function getOriginalName()
	{
		return $this->originalname;
	}

	/**
	 * Pre-update hook for file name handling.
	 *
	 * @access public
	 * @return void
	 */
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

	/**
	 * Set the filename.
	 *
	 * @param  string      $name
	 * @param  null|string $extention
	 *
	 * @access public
	 * @return string
	 */
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

				return $name;
		}
	}

}
