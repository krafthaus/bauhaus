<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Form::macro('delete', function($url, $label = 'Delete', $params = [], $options = [])
{
	if (empty($params)) {
		$params = [
			'method' => 'DELETE',
			'class'  => 'delete-form',
			'url'    => $url
		];
	} else {
		$params['url']    = $url;
		$params['method'] = 'DELETE';
	}

	return Form::open($params)
		. Form::submit($label, $options)
		. Form::close();
});