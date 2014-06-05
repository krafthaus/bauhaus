<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::filter('bauhaus.auth', function () {
	$filter = Config::get('bauhaus::admin.auth.permission');

	if ($filter() === false) {
		return Redirect::guest(Config::get('bauhaus::admin.auth.login_path'));
	}
});