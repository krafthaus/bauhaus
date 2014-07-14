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

use Illuminate\Support\Facades\Response;
use KraftHaus\Bauhaus\Export\Format\BaseFormat;
use SimpleXMLElement;

/**
 * Class XmlFormat
 * @package KraftHaus\Bauhaus\Export
 */
class XmlFormat extends BaseFormat
{

	/**
	 * Holds the content type.
	 * @var string
	 */
	protected $contentType = 'text/xml';

	/**
	 * Holds the filename.
	 * @var string
	 */
	protected $filename = 'export.xml';

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
				$value = $field->getValue();

				if (!is_string($value)) {
					$value = $value->toArray();
				}

				$result[$item->getIdentifier()][$field->getName()] = $value;
			}
		}

		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response/>');
		$this->arrayToXml($result, $xml);

		return $this->createResponse($xml->asXML());
	}

	/**
	 * Create an xml representatation from an array.
	 * 
	 * @param  array            $result
	 * @param  SimpleXMLElement $xml
	 *
	 * @access public
	 * @return void
	 */
	protected function arrayToXml($result, &$xml)
	{
		foreach ($result as $key => $value) {
			if (is_array($value)) {
				if (!is_numeric($key)) {
					$subnode = $xml->addChild((string) $key);
				} else {
					$subnode = $xml->addChild('item_' . $key);
				}
				$this->arrayToXml($value, $subnode);
			} else {
				$xml->addChild($key, $value);
			}
		}
	}

}