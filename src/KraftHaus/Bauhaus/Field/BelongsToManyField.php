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
use Illuminate\Support\Str;

/**
 * Class BelongsToManyField
 * @package KraftHaus\Bauhaus\Field
 */
class BelongsToManyField extends RelationField
{

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		if ($this->getDisplayField() === null) {
			throw new \InvalidArgumentException(sprintf('Please provide a display field for the `%s` relation.', $this->getName()));
		}

		switch ($this->getContext()) {
			case BaseField::CONTEXT_LIST:
				$model = $this->getName();

				$values = [];
				foreach ($this->getValue() as $item) {
					$values[$item->id] = $item->{$this->getDisplayField()};
				}

				return implode(', ', $values);

				break;
			case BaseField::CONTEXT_FORM:
				$baseModel = $this->getAdmin()->getModel();
				$baseModel = new $baseModel;

				$relatedModel = $baseModel->{$this->getName()}()->getRelated();

				$items = [];
				foreach ($relatedModel::all() as $item) {
					$items[$item->id] = $item->{$this->getDisplayField()};
				}

				$id = $this->getAdmin()->getFormBuilder()->getIdentifier();
				$values = [];

				if ($id !== null) {
					foreach ($baseModel::find($id)->{$relatedModel->getTable()} as $item) {
						$values[$item->id] = $item->id;
					}
				}

				return View::make('krafthaus/bauhaus::models.fields._belongs_to_many')
					->with('field',  $this)
					->with('items',  $items)
					->with('values', $values);
		}
	}

	public function postUpdate($input)
	{
		$model = $this->getAdmin()->getModel();
		$model = $model::find($this->getAdmin()->getFormBuilder()->getIdentifier());

		$pivot = $this->getName();

		$model->{$pivot}()->sync($input[$pivot]);
	}

	/**
	 * Override the getAttributes method to add the multiple attribute.
	 *
	 * @access public
	 * @return array
	 */
	public function getAttributes()
	{
		$this->attribute('multiple', true);
		return $this->attributes;
	}

}