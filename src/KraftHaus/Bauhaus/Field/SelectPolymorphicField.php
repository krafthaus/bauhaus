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
 * Class SelectField
 * @package KraftHaus\Bauhaus\Field
 */
class SelectPolymorphicField extends SelectField
{

	protected $view = 'krafthaus/bauhaus::models.fields._select';

	/**
	 * Holds the display field name.
	 * @var string
	 */
	protected $displayField = null;

	/**
	 * Set the display field name.
	 *
	 * @param  string $displayField
	 *
	 * @access public
	 * @return BelongsToField
	 */
	public function display($displayField)
	{
		$this->displayField = $displayField;
		return $this;
	}

	/**
	 * Get the display field name.
	 *
	 * @access public
	 * @return string
	 */
	public function getDisplayField()
	{
		return $this->displayField;
	}

	/**
	 * Override the parent renderer to set the polymorphic options.
	 *
	 * @access public
	 * @return mixed|string
	 */
	public function render()
	{
		$baseModel = $this->getAdmin()->getModel();
		$baseModel = $baseModel::find($this->getAdmin()->getFormBuilder()->getIdentifier());

		if (!$baseModel) {
			$baseModel = $this->getAdmin()->getModel();
			$baseModel = new $baseModel;
		}

		$relatedModel = $baseModel->{$this->getName()}()->getRelated();

		if (isset($baseModel->{$this->getName()}[0])) {
			$this->setValue($baseModel->{$this->getName()}[0]->id);
		}

		$options = [];
		foreach ($relatedModel::all() as $option) {
			$options[$option->id] = $option->path;
		}

		$this->options($options);

		return parent::render();
	}

	/**
	 * Post update hook.
	 *
	 * @param  array $input
	 *
	 * @access public
	 * @return void
	 */
	public function postUpdate($input)
	{
		$baseModel = $this->getAdmin()->getModel();
		$baseModel = $baseModel::find($this->getAdmin()->getFormBuilder()->getIdentifier());

		$morphType = $baseModel->{$this->getName()}()->getMorphType();
		$morphType = str_replace(sprintf('%s.', $this->getName()), '', $morphType);

		$foreignKey = $baseModel->{$this->getName()}()->getForeignKey();
		$foreignKey = str_replace(sprintf('%s.', $this->getName()), '', $foreignKey);

		// remove old polymorphic relations
		foreach ($baseModel->{$this->getName()} as $item) {
			$item->update([
				$foreignKey => 0,
				$morphType  => '',
			]);
		}

		// update new item with polymorphic relation
		$baseModel->{$this->getName()}()
			->getRelated()
			->where($baseModel->getKeyName(), $input[$this->getName()])
			->update([
				$foreignKey => $this->getAdmin()->getFormBuilder()->getIdentifier(),
				$morphType  => get_class($baseModel),
			]);
	}

}