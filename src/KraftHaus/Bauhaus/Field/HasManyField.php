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
 * Class HasManyField
 * @package KraftHaus\Bauhaus\Field
 */
class HasManyField extends RelationField
{

	/**
	 * Render the field.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		switch ($this->getContext()) {
			case BaseField::CONTEXT_LIST:
				$values = [];
				foreach ($this->getValue() as $item) {
					$values[] = $item->{$this->getDisplayField()};
				}

				return implode(', ', $values);

				break;
			case BaseField::CONTEXT_FORM:

				$baseModel  = $this->getAdmin()->getModel();
				$baseModel  = new $baseModel;
				$primaryKey = $baseModel->getKeyName();

				$relatedModel = $baseModel->{$this->getName()}()->getRelated();
				$relatedModel = get_class($relatedModel);

				$items = [];
				foreach ($relatedModel::all() as $item) {
					$items[$item->{$primaryKey}] = $item->{$this->getDisplayField()};
				}

				$id = $this->getAdmin()->getFormBuilder()->getIdentifier();

				$values = [];
				foreach ($relatedModel::where(Str::singular($baseModel->getTable()) . '_id', $id)->get() as $item) {
					$values[] = (string) $item->{$primaryKey};
				}

				return View::make('krafthaus/bauhaus::models.fields._has_many')
					->with('field',  $this)
					->with('items',  $items)
					->with('values', $values);

				break;
		}
	}

	public function postUpdate($input)
	{
		$baseModel = $this->getAdmin()->getModel();
		$baseModel = new $baseModel;

		$relatedModel = $baseModel->{$this->getName()}()->getRelated();
		$relatedModel = get_class($relatedModel);

		if (isset($input[$this->getName()])) {
			foreach ($input[$this->getName()] as $item) {
				$relatedModel::find($item)
					->update([strtolower(get_class($baseModel)) . '_id' => $this->getAdmin()->getFormBuilder()->getIdentifier()]);
			}
		}
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