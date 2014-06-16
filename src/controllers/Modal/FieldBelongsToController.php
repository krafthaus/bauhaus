<?php

namespace KraftHaus\Bauhaus\Modal;

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

/**
 * 
 */
class FieldBelongsToController extends Controller
{

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

		return View::make('krafthaus/bauhaus::models.modals.belongs_to')
			->with('name',  $name)
			->with('model', $model);
	}

}