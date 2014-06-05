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

/**
 * 
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
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = new $model;

		$model->buildList();
		$model->buildFilters();

		return View::make('krafthaus/bauhaus::models.index')
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
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = (new $model)->buildForm();

		return View::make('krafthaus/bauhaus::models.create')
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
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = new $model;

		$result = $model->buildForm()
			->getFormBuilder()
			->create(Input::all());

		// Check validation errors
		if (get_class($result) == 'Illuminate\Validation\Validator') {
			Session::flash('message.error', 'Validation errors');
			return Redirect::route('admin.model.create', [$name])
				->withInput()
				->withErrors($result);
		}

		// Set the flash message
		Session::flash('message.success', sprintf('Create a new `%s`.', $model->getSingularName()));
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
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = (new $model)->buildForm($id);

		return View::make('krafthaus/bauhaus::models.edit')
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
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = new $model;

		$result = $model->buildForm($id)
			->getFormBuilder()
			->update(Input::all());

		// Check validation errors
		if (get_class($result) == 'Illuminate\Validation\Validator') {
			Session::flash('message.error', 'Validation errors');
			return Redirect::route('admin.model.edit', [$name, $id])
				->withInput()
				->withErrors($result);
		}

		// Set the flash message
		Session::flash('message.success', sprintf('Updated the a `%s`.', $model->getSingularName()));
		return Redirect::route('admin.model.index', $name);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string $model
	 * @param  int  $id
	 *
	 * @access public
	 * @return Response
	 */
	public function destroy($name, $id)
	{
		//
	}

	public function multiDestroy($name)
	{
		$items = Input::get('delete');
		
		$model = sprintf('\\%sAdmin', Str::studly($name));
		$model = new $model;

		foreach ($items as $id => $item) {
			$model->buildForm($id)
				->getFormBuilder()
				->destroy();
		}

		// Set the flash message
		Session::flash('message.success', sprintf('Deleted multiple `%s`.', $model->getPluralName()));
		return Redirect::route('admin.model.index', $name);
	}

}
