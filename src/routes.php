<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(['prefix' => Config::get('bauhaus::admin.uri')], function () {

	Route::group(['before' => 'bauhaus.auth'], function () {
		Route::get('/', [
			'as'   => 'admin.dashboard',
			'uses' => 'KraftHaus\Bauhaus\DashboardController@index'
		]);

		Route::get('model/{model}', [
			'as'   => 'admin.model.index',
			'uses' => 'KraftHaus\Bauhaus\ModelController@index'
		]);

		Route::get('model/{model}/create', [
			'as'   => 'admin.model.create',
			'uses' => 'KraftHaus\Bauhaus\ModelController@create'
		]);

		Route::post('model/{model}', [
			'as'   => 'admin.model.store',
			'uses' => 'KraftHaus\Bauhaus\ModelController@store'
		]);

		Route::get('model/{model}/{id}', [
			'as'   => 'admin.model.edit',
			'uses' => 'KraftHaus\Bauhaus\ModelController@edit'
		]);

		Route::put('model/{model}/{id}', [
			'as'   => 'admin.model.update',
			'uses' => 'KraftHaus\Bauhaus\ModelController@update'
		]);

		Route::delete('model/{model}/{id}', [
			'as'   => 'admin.model.destroy',
			'uses' => 'KraftHaus\Bauhaus\ModelController@destroy'
		]);

		Route::post('model/{model}/multi-destroy', [
			'as'   => 'admin.model.multi-destroy',
			'uses' => 'KraftHaus\Bauhaus\ModelController@multiDestroy'
		]);

		Route::get('model/{model}/export/{type}', [
			'as'   => 'admin.model.export',
			'uses' => 'KraftHaus\Bauhaus\ModelController@export'
		])->where('type', 'json|xml|csv|xls');

		// extra route includes
		require_once __DIR__ . '/routes/modals.php';
	});

});