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
use Illuminate\Support\Facades\Input;

/**
 * Class BelongsToField
 * @package KraftHaus\Bauhaus\Field
 */
class BelongsToField extends RelationField
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
			throw new \InvalidArgumentException(sprintf('Please provide a display field for the `%s` relation via the display(); method.', $this->getName()));
		}

		switch ($this->getContext()) {
			case BaseField::CONTEXT_LIST:
				$value = $this->getValue();
				return $value->{$this->getDisplayField()};
				break;

			case BaseField::CONTEXT_FILTER:
                $baseModel  = $this->getAdmin()->getModel();
                $baseModel  = new $baseModel;
				$primaryKey = $baseModel->getKeyName();

                $relatedModel = $baseModel->{$this->getName()}()->getRelated();

                $items = [];
                foreach ($relatedModel::all() as $item) {
                    $items[$item->{$primaryKey}] = $item->{$this->getDisplayField()};
                }

                $column = Str::singular($relatedModel->getTable()) . '_id';
                if (Input::has($column)) {
                    $this->setValue(Input::get($column));
                }

				return View::make('krafthaus/bauhaus::models.fields._belongs_to')
					->with('field', $this)
					->with('items', $items);
				break;

			case BaseField::CONTEXT_FORM:
				$baseModel  = $this->getAdmin()->getModel();
				$baseModel  = new $baseModel;
				$primaryKey = $baseModel->getKeyName();

				$relatedModel = $baseModel->{$this->getName()}()->getRelated();

				$items = [];
				foreach ($relatedModel::all() as $item) {
					$items[$item->{$primaryKey}] = $item->{$this->getDisplayField()};
				}

				if ($this->getValue() !== null) {
					$this->setValue($this->getValue()->{$primaryKey});
				}

				return View::make('krafthaus/bauhaus::models.fields._belongs_to')
					->with('field', $this)
					->with('items', $items);

				break;
		}

		return $this->getValue();
	}

}