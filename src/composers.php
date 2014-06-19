<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * View composer to make the menu available on all the views.
 */
View::composer('krafthaus/bauhaus::*', function ($view) {
	 $view->with('menu', app('krafthaus.bauhaus.menu')->build());
});