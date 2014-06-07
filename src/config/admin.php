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
	'title' => 'KraftHaus Bauhaus',

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
		[
			'type' => 'KraftHaus\Bauhaus\Block\TextBlock',
			'content' => '
				<h3>Welcome to the Bauhaus admin mapper.</h3>
				<p>	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, velit incidunt nostrum neque cumque fugiat debitis voluptas beatae corrupti vero tempore repudiandae corporis repellat sapiente laudantium odio ad? Earum, sit.</p>
			'
		]
	]

];