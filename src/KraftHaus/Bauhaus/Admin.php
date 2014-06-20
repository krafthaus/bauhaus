<?php

namespace KraftHaus\Bauhaus;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Mapper\ListMapper;
use KraftHaus\Bauhaus\Mapper\FormMapper;
use KraftHaus\Bauhaus\Mapper\FilterMapper;
use KraftHaus\Bauhaus\Mapper\ScopeMapper;
use KraftHaus\Bauhaus\Builder\ListBuilder;
use KraftHaus\Bauhaus\Builder\FormBuilder;
use KraftHaus\Bauhaus\Builder\FilterBuilder;
use Illuminate\Support\Str;

/**
 * Class Admin
 * @package KraftHaus\Bauhaus
 */
class Admin
{

	/**
	 * Holds the model name.
	 * @var null|string
	 */
	protected $model = null;

	/**
	 * Holds the number of items per page.
	 * @var int
	 */
	protected $perPage = 25;

	/**
	 * Holds the singular name of the model.
	 * @var null|string
	 */
	protected $singularName = null;

	/**
	 * Holds the plural name of the model.
	 * @var null|string
	 */
	protected $pluralName = null;

	/**
	 * Holds the ListMapper object.
	 * @var ListMapper
	 */
	protected $listMapper;

	/**
	 * Holds the ListBuilder object.
	 * @var ListBuilder
	 */
	protected $listBuilder;

	/**
	 * Holds the FormMapper object.
	 * @var FormMapper
	 */
	protected $formMapper;

	/**
	 * Holds the FormBuilder object.
	 * @var FormBuilder
	 */
	protected $formBuilder;

	/**
	 * Holds the FilterMapper object.
	 * @var FilterMapper
	 */
	protected $filterMapper;

	/**
	 * Holds the FilterBuilder object.
	 * @var FilterBuilder
	 */
	protected $filterBuilder;

	/**
	 * Holds the ScopeMapper object.
	 * @var ScopeMapper
	 */
	protected $scopeMapper;

	/**
	 * Holds the ScopeBuilder object.
	 * @var ScopeBuilder
	 */
	protected $scopeBuilder;

	/**
	 * Public class constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		if ($this->getModel() === null) {
			$this->setModel(str_replace('Admin', '', get_called_class()));
		}

		if ($this->getSingularName() === null) {
			$this->setSingularName(Str::singular($this->getModel()));
		}

		if ($this->getPluralName() === null) {
			$this->setPluralName(Str::plural($this->getModel()));
		}
	}

	/**
	 * Set the model name.
	 *
	 * @param  string $model
	 *
	 * @access public
	 * @return $this
	 */
	public function setModel($model)
	{
		$this->model = $model;
		return $this;
	}

	/**
	 * Get the model name.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Get the model table name.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getTable()
	{
		$model = $this->getModel();
		return (new $model)->getTable();
	}

	/**
	 * Sets the number of items per page.
	 *
	 * @param  int $perPage
	 *
	 * @access public
	 * @return $this
	 */
	public function setPerPage($perPage)
	{
		$this->perPage = (int) $perPage;
		return $this;
	}

	/**
	 * Gets the number of items per page.
	 *
	 * @access public
	 * @return int
	 */
	public function getPerPage()
	{
		return $this->perPage;
	}

	/**
	 * Set the model name in singular form.
	 *
	 * @param  string $singularName
	 *
	 * @access public
	 * @return Admin
	 */
	public function setSingularName($singularName)
	{
		$this->singularName = $singularName;
		return $this;
	}

	/**
	 * Get the model name in singular form.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getSingularName()
	{
		return $this->singularName;
	}

	/**
	 * Set the model name in plural form.
	 *
	 * @param  string $pluralName
	 *
	 * @access public
	 * @return Admin
	 */
	public function setPluralName($pluralName)
	{
		$this->pluralName = $pluralName;
		return $this;
	}

	/**
	 * Get the model name in plural form.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getPluralName()
	{
		return $this->pluralName;
	}

	/**
	 * This function is called when configuring the list view.
	 *
	 * @param  ListMapper $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function configureList($mapper)
	{
		// intentionally left blank
	}

	/**
	 * Configures the list fields and builds the list data from that.
	 *
	 * @access public
	 * @return Admin
	 */
	public function buildList()
	{
		$this->setListMapper(new ListMapper);
		$this->configureList($this->getListMapper());

		$this->setListBuilder(new ListBuilder($this->getListMapper()));
		$this->getListBuilder()
			->setModel($this->getModel())
			->build();

		return $this;
	}

	/**
	 * Set the ListMapper object.
	 *
	 * @param  ListMapper $mapper
	 *
	 * @access public
	 * @return Admin
	 */
	public function setListMapper(ListMapper $mapper)
	{
		$this->listMapper = $mapper;
		$mapper->setAdmin($this);
		return $this;
	}

	/**
	 * Returns the ListMapper object.
	 *
	 * @access public
	 * @return ListMapper
	 */
	public function getListMapper()
	{
		return $this->listMapper;
	}

	/**
	 * Sets the ListBuilder object.
	 *
	 * @param  ListBuilder $builder
	 *
	 * @access public
	 * @return $this
	 */
	public function setListBuilder(ListBuilder $builder)
	{
		$this->listBuilder = $builder;
		return $this;
	}

	/**
	 * Returns the ListBuilder object.
	 *
	 * @access public
	 * @return ListBuilder
	 */
	public function getListBuilder()
	{
		return $this->listBuilder;
	}

	/**
	 * This function is called when configuring the form view.
	 *
	 * @param  FormMapper $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function configureForm($mapper)
	{
		// intentionally left blank
	}

	/**
	 * Configures the list fields and builds the list data from that.
	 *
	 * @access public
	 * @return Admin
	 */
	public function buildForm($identifier = null)
	{
		$this->setFormMapper(new FormMapper);
		$this->configureForm($this->getFormMapper());

		$this->setFormBuilder(new FormBuilder($this->getFormMapper()));
		$this->getFormBuilder()
			->setModel($this->getModel())
			->setIdentifier($identifier)
			->build();

		return $this;
	}

	/**
	 * Set the FormMapper object.
	 *
	 * @param  FormMapper $mapper
	 *
	 * @access public
	 * @return Admin
	 */
	public function setFormMapper(FormMapper $mapper)
	{
		$this->formMapper = $mapper;
		$mapper->setAdmin($this);
		return $this;
	}

	/**
	 * Get the FormMapper object.
	 *
	 * @access public
	 * @return mixed
	 */
	public function getFormMapper()
	{
		return $this->formMapper;
	}

	/**
	 * Set the FormBuilder object.
	 *
	 * @param  FormBuilder $builder
	 *
	 * @access public
	 * @return Admin
	 */
	public function setFormBuilder(FormBuilder $builder)
	{
		$this->formBuilder = $builder;
		return $this;
	}

	/**
	 * Get the FormBuilder object.
	 *
	 * @access public
	 * @return FormBuilder
	 */
	public function getFormBuilder()
	{
		return $this->formBuilder;
	}

	/**
	 * This function is called when configuring the filter view.
	 *
	 * @param  FilterMapper $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function configureFilters($mapper)
	{
		// intentionally left blank
	}

	/**
	 * Configures the filter fields and builds the filter data from that.
	 *
	 * @access public
	 * @return Admin
	 */
	public function buildFilters()
	{
		$this->setFilterMapper(new FilterMapper);
		$this->configureFilters($this->getFilterMapper());

		$this->setFilterBuilder(new FilterBuilder($this->getFilterMapper()));
		$this->getFilterBuilder()
			->build();

		return $this;
	}

	/**
	 * Set the ListMapper object.
	 * 
	 * @param  FilterMapper $mapper
	 *
	 * @access public
	 * @return Admin
	 */
	public function setFilterMapper($mapper)
	{
		$this->filterMapper = $mapper;
        $mapper->setAdmin($this);
		return $this;
	}

	/**
	 * Get the ListMapper object.
	 *
	 * @access public
	 * @return ListMapper
	 */
	public function getFilterMapper()
	{
		return $this->filterMapper;
	}

	/**
	 * Set the FilterBuilder object.
	 * 
	 * @param  FilterBuilder $filterBuilder
	 *
	 * @access public
	 * @return Admin
	 */
	public function setFilterBuilder($filterBuilder)
	{
		$this->filterBuilder = $filterBuilder;
		return $this;
	}

	/**
	 * Get the FilterBuilder object.
	 *
	 * @access public
	 * @return Admin
	 */
	public function getFilterBuilder()
	{
		return $this->filterBuilder;
	}

	/**
	 * This function is called when configuring the scopes view.
	 *
	 * @param  ScopeMapper $mapper
	 *
	 * @access public
	 * @return void
	 */
	public function configureScopes($mapper)
	{
		// intentionally left blank
	}

	/**
	 * Configures the scopes and builds the scope data from that.
	 *
	 * @access public
	 * @return Admin
	 */
	public function buildScopes()
	{
		$this->setScopeMapper(new ScopeMapper);
		$this->configureScopes($this->getScopeMapper());

		$this->setScopeBuilder(new FilterBuilder($this->getScopeMapper()));
		$this->getScopeBuilder()
			->build();

		return $this;
	}

	/**
	 * Set the ScopeMapper object.
	 *
	 * @param  ScopeMapper $mapper
	 *
	 * @access public
	 * @return Admin
	 */
	public function setScopeMapper($mapper)
	{
		$this->scopeMapper = $mapper;
		$mapper->setAdmin($this);
		return $this;
	}

	/**
	 * Get the ScopeMapper object.
	 *
	 * @access public
	 * @return ScopeMapper
	 */
	public function getScopeMapper()
	{
		return $this->scopeMapper;
	}

	/**
	 * Set the ScopeBuilder object.
	 *
	 * @param  ScopeBuilder $scopeBuilder
	 *
	 * @access public
	 * @return Admin
	 */
	public function setScopeBuilder($scopeBuilder)
	{
		$this->scopeBuilder = $scopeBuilder;
		return $this;
	}

	/**
	 * Get the ScopeBuilder object.
	 *
	 * @access public
	 * @return ScopeBuilder
	 */
	public function getScopeBuilder()
	{
		return $this->scopeBuilder;
	}

}