<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

	/**
	 * Package URI.
	 * @var string
	 */
	'uri' => 'admin',

	/**
	 * The package main title.
	 * @var string
	 */
	'title' => 'Bauhaus',

	/**
	 * The directory where the bauhaus models are located.
	 * @var string
	 */
	'directory' => 'admin',

	/**
	 * Authorization filter settings.
	 * @var array
	 */
	'auth' => [

		/**
		 * The permission filter.
		 * @var string
		 */
		'permission' => function () {
			return true;
		},

		/**
		 * The uri used to redirect if the auth filter fails.
		 * @var string
		 */
		'login_path' => 'admin/sign-in',

		/**
		 * The uri used to sign the user out.
		 * @var string
		 */
		'logout_path' => 'admin/sign-out'
	],

	/**
	 * The menu structure of the package.
	 * @var array
	 */
	'menu' => [
		// ...
	],

	'dashboard' => [
		'top' => [
			[
				'type' => 'KraftHaus\Bauhaus\Block\TextBlock',
				'content' => '
					<h3>Welcome to the Bauhaus admin mapper.</h3>
					<p>To modify this dashboard, please view the `app/config/krafthaus/bauhaus/admin.php` file.</p>
				'
			]
		]
	],

	/**
	 * Custom asset files.
	 * Use these settings to ad custom asset files to the layout (css / js).
	 */
	'assets' => [
		'stylesheets' => [
			// Custom stylesheet file.
			// asset('stylesheets/custom-admin.css')
		],
		'javascripts' => [
			// Custom javascript file.
			// asset('javascripts/custom-admin.js')
		]
	],

	/**
	 * Global date/time formatting.
	 * @var array
	 */
	'date_format' => [
		'date'     => 'Y-m-d',
		'time'     => 'H:i:s',
		'datetime' => 'Y-m-d H:i:s'
	],

	'export-types' => [
		'json',
		'xml',
		'csv',
		'xls'
	],

	/**
	 * How to serialize `multiple` fields.
	 *  - explode
	 *  - json
	 *  - serialize
	 */
	'multiple-serializer' => 'json'

];