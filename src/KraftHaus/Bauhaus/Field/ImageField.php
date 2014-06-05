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

use KraftHaus\Bauhaus\Field\FileField;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Image;

/**
 * Class ImageField
 * @package KraftHaus\Bauhaus\Field
 */
class ImageField extends FileField
{

	/**
	 * Holds the image sizes.
	 * @var array
	 */
	protected $sizes = [];

	/**
	 * Set the image sizes.
	 *
	 * @param  array $sizes
	 *
	 * @access public
	 * @return ImageField
	 */
	public function sizes(array $sizes)
	{
		$this->sizes = $sizes;
		return $this;
	}

	/**
	 * Get the image sizes.
	 *
	 * @access public
	 * @return array
	 */
	public function getSizes()
	{
		return $this->sizes;
	}

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make('krafthaus/bauhaus::models.fields._image')
			->with('field', $this);
	}

	/**
	 * Upload the image.
	 *
	 * @param  array $input
	 *
	 * @access public
	 * @return void
	 */
	public function postUpdate($input)
	{
		foreach ($this->getSizes() as $size) {
			if (Input::hasFile($this->getName())) {
				$file = Input::file($this->getName());
				$name = $file->getClientOriginalName();

				$image = Image::make(sprintf('%s/%s', $this->getLocation(), $name));

				switch ($size[2]) {
					case 'resize':
						$image->resize($size[0], $size[1], function ($constraint) {
							$constraint->aspectRatio();
						});
						break;
					case 'resizeCanvas':
						$image->resizeCanvas($size[0], $size[1], 'center');
						break;
					case 'fit':
						$image->fit($size[0], $size[1]);
						break;
				}

				$image->save($size[3] . '/' . $name);
			}
		}

		parent::postUpdate($input);
	}

}