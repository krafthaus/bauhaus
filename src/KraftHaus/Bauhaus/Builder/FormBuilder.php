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

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use KraftHaus\Bauhaus\Result\FormResult;
use KraftHaus\Bauhaus\Field\BaseField;
use KraftHaus\Bauhaus\Util\Value;

/**
 * Class ListBuilder
 * @package KraftHaus\Bauhaus\Builder
 */
class FormBuilder extends BaseBuilder
{

	const CONTEXT_CREATE = 'create';
	const CONTEXT_EDIT = 'edit';

	/**
	 * Holds the form result.
	 * @var array
	 */
	protected $result = [];

	/**
	 * Holds the record identifier(id).
	 * @var int
	 */
	protected $identifier;

	/**
	 * Set the form identifier.
	 *
	 * @param  int $identifier
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function setIdentifier($identifier)
	{
		$this->identifier = $identifier;
		return $this;
	}

	/**
	 * Get the form identifier.
	 *
	 * @access public
	 * @return int
	 */
	public function getIdentifier()
	{
        $model = $this->getModel();
        if ($this->identifier !== null && method_exists($model, 'castIdentifier')) {
            $this->identifier = $model::castIdentifier($this->identifier);
        }
		return $this->identifier;
	}

	/**
	 * Set the form context.
	 *
	 * @param  FormBuilder $context
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function setContext($context)
	{
		$this->context = $context;
		return $this;
	}

	/**
	 * Get the form context.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getContext()
	{
		return $this->context;
	}

	/**
	 * Build the list data.
	 *
	 * @access public
	 * @return mixed|void
	 */
	public function build()
	{
		$formMapper = $this->getMapper();
		$model      = $this->getModel();
		$primaryKey = (new $model)->getKeyName();

		/**
		 * Empty form
		 */
		$result = new FormResult();
		if ($this->getIdentifier() === null) {
			foreach ($formMapper->getFields() as $field) {
				$clone = clone $field;
				$name  = $clone->getName();

				// Is this a multiple field?
				if ($clone->isMultiple()) {
					$clone->setValue(['']);
				}

				$clone->setContext(BaseField::CONTEXT_FORM);
				$result->addField($name, $clone);
			}

			$this->setResult($result);
			return;
		}

		$items = $model::with([]);

		$items->where($primaryKey, $this->getIdentifier());
		$item = $items->first();

		// modifyModelItem hook
		if (method_exists($this->getMapper()->getAdmin(), 'modifyModelItem')) {
			$item = $this->getMapper()->getAdmin()->modifyModelItem($item);
		}

		$result = new FormResult;
		$result->setIdentifier($item->{$primaryKey});

		foreach ($formMapper->getFields() as $field) {
			$clone = clone $field;
			$name  = $clone->getName();
			$value = $item->{$name};

			if ($clone->hasBefore()) {
				$before = $clone->getBefore();

				if ($before instanceof Closure) {
					$value = $before($value);
				} else {
					$value = $before;
				}
			}

			// Is this a multiple field?
			if ($clone->isMultiple()) {
				$value = Value::decode(Config::get('bauhaus::admin.multiple-serializer'), $value);
			}

			$clone
				->setContext(BaseField::CONTEXT_FORM)
				->setValue($value);

			$result->addField($name, $clone);
		}

		$this->setResult($result);
	}

	/**
	 * Sets the form result.
	 *
	 * @param  array $result
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function setResult(FormResult $result)
	{
		$this->result = $result;
		return $this;
	}

	/**
	 * Returns the form result.
	 *
	 * @access public
	 * @return array
	 */
	public function getResult()
	{
		return $this->result;
	}

	/**
	 * Create a new model from input.
	 * 
	 * @param  Input $input
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function create($input)
	{
		$mapper = $this->getMapper();
		$admin  = $mapper->getAdmin();

		$model      = $this->getModel();
		$primaryKey = (new $model)->getKeyName();

		$this->setInput($input);

		// Field pre update
		foreach ($mapper->getFields() as $field) {
			$field->preUpdate();
			$input = $this->getInput();

			// Is this a multiple field?
			if ($field->isMultiple()) {
				$value = Value::encode(Config::get('bauhaus::admin.multiple-serializer'), $input[$field->getName()]);
				$this->setInputVariable($field->getName(), $value);
			}

			if ($field->hasSaving()) {
				$saving = $field->getSaving();
				$this->setInputVariable($field->getName(), $saving($input[$field->getName()]));
			}
		}

		// Model before create hook
		if (method_exists($admin, 'beforeCreate')) {
			$admin->beforeCreate($input);
		}

		// Validate
		if (property_exists($model, 'rules')) {
			$validator = Validator::make($this->getInput(), $model::$rules);
			if ($validator->fails()) {
				return $validator;
			}
		}

		// Model create hook
		if (method_exists($admin, 'create')) {
			$model = $admin->create($this->getInput());
		} else {
			$model = $model::create($this->getInput());
		}

		// Set the primary id from the `new` model
		$this->setIdentifier($model->{$primaryKey});

		// Field post update
		foreach ($mapper->getFields() as $field) {
			$field->postUpdate($this->getInput());
		}

		// Model after create hook
		if (method_exists($admin, 'afterCreate')) {
			$result = $admin->afterCreate($this->getInput());

			if ($result instanceof \Illuminate\Http\RedirectResponse) {
				$result->send();
			}
		}

		return $this;
	}

	/**
	 * Update a model from input.
	 * 
	 * @param  Input $input
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function update($input)
	{
		$mapper = $this->getMapper();
		$admin  = $mapper->getAdmin();

		$model = $this->getModel();
		$this->setInput($input);

		// Field pre update
		foreach ($this->getMapper()->getFields() as $field) {
			$field->preUpdate();

			// Is this a multiple field?
			if ($field->isMultiple()) {
				$value = Value::encode(Config::get('bauhaus::admin.multiple-serializer'), $input[$field->getName()]);
				$this->setInputVariable($field->getName(), $value);
			}

			if ($field->hasSaving()) {
				$saving = $field->getSaving();
				$this->setInputVariable($field->getName(), $saving($input[$field->getName()]));
			}
		}

		// Model before update hook
		if (method_exists($admin, 'beforeUpdate')) {
			$admin->beforeUpdate($input);
		}

		// Validate
		if (property_exists($model, 'rules')) {
			$validator = Validator::make($this->getInput(), $model::$rules);
			if ($validator->fails()) {
				return $validator;
			}
		}

		// Model update hook
		if (method_exists($this->getMapper()->getAdmin(), 'update')) {
			$this->getMapper()->getAdmin()->update($this->getInput());
		} else {
			$model::find($this->getIdentifier())
				->update($this->getInput());
		}

		// Field post update
		foreach ($this->getMapper()->getFields() as $field) {
			$field->postUpdate($this->getInput());
		}

		// Model after update hook
		if (method_exists($admin, 'afterCreate')) {
			$result = $admin->afterUpdate($this->getInput());

			if ($result instanceof \Illuminate\Http\RedirectResponse) {
				$result->send();
			}
		}

		return $this;
	}

	/**
	 * Destroy a specific item.
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function destroy()
	{
		$mapper = $this->getMapper();
		$admin  = $mapper->getAdmin();

		$model = $this->getModel();
		$model = $model::find($this->getIdentifier());

		// Model before delete hook
		if (method_exists($admin, 'beforeDelete')) {
			$admin->beforeDelete($model);
		}

		// Model delete hook
		if (method_exists($admin, 'deleting')) {
			$admin->deleting($model);
		} else {
			$model->delete();
		}

		// Model after delete hook
		if (method_exists($admin, 'afterDelete')) {
			$result = $admin->afterDelete($model);

			if ($result instanceof \Illuminate\Http\RedirectResponse) {
				$result->send();
			}
		}

		return $this;
	}

}
