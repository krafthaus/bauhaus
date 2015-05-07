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

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use KraftHaus\Bauhaus\Facade\Bauhaus;

/**
 * Class ModelController
 * @package KraftHaus\Bauhaus
 */
class ModelController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string $name
	 * 
	 * @access public
	 * @return Response
	 */
	public function index($name)
	{
		$model = Bauhaus::getInstance($name)
			->buildList()
			->buildFilters()
			->buildScopes();

		return View::make($model->getView('list'))
			->with('name',  $name)
			->with('model', $model);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  string $model
	 * 
	 * @access public
	 * @return Response
	 */
	public function create($name)
	{
		$model = Bauhaus::getInstance($name)->buildForm();

		return View::make($model->getView('create'))
			->with('name',  $name)
			->with('model', $model);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  string $name
	 * 
	 * @access public
	 * @return Response
	 */
	public function store($name)
	{
		$model  = Bauhaus::getInstance($name);
		$result = $model->buildForm()
			->getFormBuilder()
			->create(Input::except('_token'));

		// Check validation errors
		if (get_class($result) == 'Illuminate\Validation\Validator') {
			Session::flash('message.error', trans('bauhaus::messages.error.validation-errors'));
			return Redirect::route('admin.model.create', [$name])
				->withInput()
				->withErrors($result);
		}

		// Set the flash message
		Session::flash('message.success', trans('bauhaus::messages.success.model-created', [
			'model' => $model->getSingularName()
		]));

		// afterStore hook
		if (method_exists($model, 'afterStore')) {
			return $model->afterStore(Redirect::route('admin.model.index', $name));
		}

		return Redirect::route('admin.model.index', $name);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string $name
	 * @param  int    $id
	 *
	 * @access public
	 * @return Response
	 */
	public function edit($name, $id)
	{
		$model = Bauhaus::getInstance($name)->buildForm($id);

		return View::make($model->getView('edit'))
			->with('name',  $name)
			->with('model', $model)
			->with('id',    $id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string $name
	 * @param  int  $id
	 *
	 * @access public
	 * @return Response
	 */
	public function update($name, $id)
	{
		$model  = Bauhaus::getInstance($name);
		$result = $model->buildForm($id)
			->getFormBuilder()
			->update(Input::except('_token'));

		// Check validation errors
		if (get_class($result) == 'Illuminate\Validation\Validator') {
			Session::flash('message.error', trans('bauhaus::messages.error.validation-errors'));
			return Redirect::route('admin.model.edit', [$name, $id])
				->withInput()
				->withErrors($result);
		}

		// Set the flash message
		Session::flash('message.success', trans('bauhaus::messages.success.model-updated', [
			'model' => $model->getSingularName()
		]));

		// afterUpdate hook
		if (method_exists($model, 'afterUpdate')) {
			return $model->afterUpdate(Redirect::route('admin.model.index', $name));
		}

		return Redirect::route('admin.model.index', $name);
	}

	/**
	 * Remove the specified resources from storage.
	 *
	 * @param  string $model
	 * @param  int  $id
	 *
	 * @access public
	 * @return Response
	 */
	public function multiDestroy($name)
	{
		$items = Input::get('delete');
		$model = Bauhaus::getInstance($name);

		if (count($items) === 0) {
			return Redirect::route('admin.model.index', $name);
		}

		foreach ($items as $id => $item) {
			$model->buildForm($id)
				->getFormBuilder()
				->destroy();
		}

		// Set the flash message
		Session::flash('message.success', trans('bauhaus::messages.success.model-deleted', [
			'count' => (count($items) > 1 ? 'multiple' : 'one'),
			'model' => $model->getPluralName()
		]));

		// afterMultiDestroy hook
		if (method_exists($model, 'afterMultiDestroy')) {
			return $model->afterMultiDestroy(Redirect::route('admin.model.index', $name));
		}

		return Redirect::route('admin.model.index', $name);
	}

	/**
	 * Export the current listing of the resources.
	 *
	 * @param  string $name
	 * @param  string $type
	 *
	 * @access public
	 * @return Response
	 */
	public function export($name, $type)
	{
		$model = Bauhaus::getInstance($name)
			->buildList()
			->buildFilters()
			->buildScopes();

		return $model->getExportBuilder()
			->export($type);
	}

}
