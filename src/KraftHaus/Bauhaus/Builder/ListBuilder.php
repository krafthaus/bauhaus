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

use KraftHaus\Bauhaus\Result\ListResult;
use KraftHaus\Bauhaus\Field\BaseField;
use Illuminate\Support\Facades\Input;

/**
 * Class ListBuilder
 * @package KraftHaus\Bauhaus\Builder
 */
class ListBuilder extends BaseBuilder
{

	/**
	 * Holds the list result.
	 * @var array
	 */
	protected $result = [];

	protected $paginator;

	/**
	 * Build the list data.
	 *
	 * @access public
	 * @return mixed|void
	 */
	public function build()
	{
		$listMapper = $this->getMapper();

		$model = $this->getModel();
		$items = $model::with([]);

		// Field ordering
		if (Input::has('order_by')) {
			// ...
		}

		// Field filters
		foreach (Input::all() as $key => $value) {
			if (empty($value) || substr($key, 0, 1) == '_') {
				continue;
			}

			$items->where($key, 'LIKE', '%' . $value . '%');
		}

		$items = $items->paginate($listMapper->getAdmin()->getPerPage());
		$this->setPaginator($items);

		$result = [];
		foreach ($items as $item) {
			$row = new ListResult;
			$row->setIdentifier($item->id);

			foreach ($listMapper->getFields() as $field) {
				$clone = clone $field;
				$name  = $clone->getName();
				$value = $item->{$name};

				if ($clone->hasBefore()) {
					$before = $clone->getBefore();
					$value  = $before($value);
				}

				$clone
					->setContext(BaseField::CONTEXT_LIST)
					->setRowId($item->id)
					->setValue($value);

				$row->addField($name, $clone);
			}

			$result[] = $row;
		}

		$this->setResult($result);
	}

	/**
	 * Sets the list result.
	 *
	 * @param  array $result
	 *
	 * @access public
	 * @return ListBuilder
	 */
	public function setResult(array $result)
	{
		$this->result = $result;
		return $this;
	}

	/**
	 * Returns the list result.
	 *
	 * @access public
	 * @return array
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * Set the paginator object.
	 * 
	 * @param  Paginator $paginator
	 *
	 * @access public
	 * @return ListBuilder
	 */
	public function setPaginator($paginator)
	{
		$this->paginator = $paginator;
		return $this;
	}

	/**
	 * Get the paginator object.
	 * @return Paginator
	 */
	public function getPaginator()
	{
		return $this->paginator;
	}

}