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
 * Class LabelField
 * @package KraftHaus\Bauhaus\Field
 */
class LabelField extends BaseField
{

	/**
	 * Holds the view path.
	 * @var string
	 */
	protected $view = 'krafthaus/bauhaus::models.fields._label';

	/**
	 * Holds the label states.
	 * @var array
	 */
	protected $states = [];

	/**
	 * Set the label states.
	 *
	 * @param  array $states
	 *
	 * @access public
	 * @return $this
	 */
	public function state(array $states = [])
	{
		$this->states = $states;
		return $this;
	}

	/**
	 * Get the label states.
	 *
	 * @access public
	 * @return array
	 */
	public function getStates()
	{
		return $this->states;
	}

	public function getState($state = null)
	{
		if ($state === null) {
			$state = $this->getValue();
		}

		if (!isset($this->states[$state])) {
			return 'default';
		}

		return $this->states[$state];
	}

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		return View::make($this->view)
			->with('field', $this);
	}

}