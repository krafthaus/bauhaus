<?php

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('modal/belongs_to/{model}/create', [
	'as'   => 'modal.belongs_to.create',
	'uses' => 'KraftHaus\Bauhaus\Modal\FieldBelongsToController@create'
]);