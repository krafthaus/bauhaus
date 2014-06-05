<?php

namespace KraftHaus\Bauhaus\Builder;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Result\FilterResult;
use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\Input;

/**
 * Class ListBuilder
 * @package KraftHaus\Bauhaus\Builder
 */
class FilterBuilder extends BaseBuilder
{

	/**
	 * Holds the filter result.
	 * @var array
	 */
	protected $result = [];

	/**
	 * Build the filter data.
	 * @return mixed|void
	 */
	public function build()
	{
		$filterMapper = $this->getMapper();
		$input = Input::all();

		$result = new FilterResult();
		foreach ($filterMapper->getFields() as $field) {
			$clone = clone $field;
			$name  = $clone->getName();

			if (Input::has($name)) {
				$clone->setValue($input[$name]);
			}

			$clone->setContext(BaseField::CONTEXT_FILTER);

			$result->addField($name, $clone);
		}
		$this->setResult($result);
	}

	/**
	 * Sets the filter result.
	 *
	 * @param  array $result
	 *
	 * @access public
	 * @return FilterBuilder
	 */
	public function setResult(FilterResult $result)
	{
		$this->result = $result;
		return $this;
	}

	/**
	 * Returns the filter result.
	 *
	 * @access public
	 * @return array
	 */
	public function getResult()
	{
		return $this->result;
	}

}