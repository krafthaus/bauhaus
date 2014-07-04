<?php

namespace KraftHaus\Bauhaus\Export\Format;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use KraftHaus\Bauhaus\Export\Format\BaseFormat;

/**
 * Class JsonFormat
 * @package KraftHaus\Bauhaus\Export
 */
class JsonFormat extends BaseFormat
{

	/**
	 * Create the json response.
	 *
	 * @access public
	 * @return JsonResponse|mixed
	 */
	public function export()
	{
		$result = [];
		foreach ($this->getListBuilder()->getResult() as $item) {
			foreach ($item->getFields() as $field) {
				$result[$item->getIdentifier()][$field->getName()] = $field->getValue();
			}
		}

		return Response::make(Response::json($result)->getContent(), 200, [
			'Content-Type'        => 'application/json',
			'Content-Disposition' => 'attachment; filename="export.json"',
		]);
	}

}