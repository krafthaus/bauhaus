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

/**
 * Class DashboardController
 * @package KraftHaus\Bauhaus
 */
class DashboardController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('krafthaus/bauhaus::dashboard.index');
	}

}
