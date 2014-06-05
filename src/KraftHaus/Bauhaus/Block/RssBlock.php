<?php

namespace KraftHaus\Bauhaus\Block;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Block\BaseBlock;
use Illuminate\Support\Facades\View;

/**
 * Class RssBlock
 * @package KraftHaus\Bauhaus\Block
 */
class RssBlock extends BaseBlock
{

	/**
	 * Render the rss block.
	 *
	 * @access public
	 * @return View
	 */
	public function render()
	{
		$feed = $this->compose();
		return View::make('krafthaus/bauhaus::blocks.rss')
			->with('title', $this->getArgument('title'))
			->with('feed', $feed);
	}

	/**
	 * Compose the rss data.
	 *
	 * @access public
	 * @return \SimpleXMLElement
	 */
	protected function compose()
	{
		$content = file_get_contents($this->getArgument('url'));
		$xml = simplexml_load_string($content);

		return $xml;
	}
	
}