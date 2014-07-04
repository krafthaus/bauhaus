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

/**
 * Class BaseFormat
 * @package KraftHaus\Bauhaus\Export\Format
 * @abstract
 */
abstract class BaseFormat
{

	/**
	 * Holds the content-type.
	 * @var null
	 */
	protected $contentType = null;

	/**
	 * Holds the filename.
	 * @var string
	 */
	protected $filename = null;

	/**
	 * Holds the ListBuilder object.
	 * @var \KraftHaus\Bauhaus\Builder\ListBuilder
	 */
	protected $listBuilder;

	/**
	 * Create a new export based on the ListBuilder object.
	 *
	 * @return mixed
	 * @abstract
	 */
	abstract public function export();

	/**
	 * Set the ListBuilder instance.
	 *
	 * @param  \KraftHaus\Bauhaus\Builder $listBuilder
	 *
	 * @access public
	 * @return Builder
	 */
	public function setListBuilder($listBuilder)
	{
		$this->listBuilder = $listBuilder;
		return $this;
	}

	/**
	 * Get the ListBuilder object.
	 *
	 * @access public
	 * @return \KraftHaus\Bauhaus\Builder\ListBuilder
	 */
	public function getListBuilder()
	{
		return $this->listBuilder;
	}

	/**
	 * Set the content-type.
	 *
	 * @param  string $contentType
	 *
	 * @access public
	 * @return BaseFormat
	 */
	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
		return $this;
	}

	/**
	 * Get the content-type.
	 *
	 * @access public
	 * @return null
	 */
	public function getContentType()
	{
		return $this->contentType;
	}

	/**
	 * Set the download filename.
	 *
	 * @param  string $filename
	 *
	 * @access public
	 * @return BaseFormat
	 */
	public function setFilename($filename)
	{
		$this->filename = $filename;
		return $this;
	}

	/**
	 * Get the download filename.
	 *
	 * @access public
	 * @return string
	 */
	public function getFilename()
	{
		return $this->filename;
	}

	/**
	 * Create the download response.
	 *
	 * @param  string $result
	 *
	 * @access public
	 * @return mixed
	 */
	public function createResponse($result)
	{
		return Response::make($result, 200, [
			'Content-Type'        => $this->getContentType(),
			'Content-Disposition' => sprintf('attachment; filename="%s"', $this->getFilename()),
		]);
	}

}