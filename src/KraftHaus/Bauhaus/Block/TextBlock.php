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
 * Class TextBlock
 * @package KraftHaus\Bauhaus\Block
 */
class TextBlock extends BaseBlock
{

	/**
	 * Render the TextBlock.
	 *
	 * @access public
	 * @return View
	 */
	public function render()
	{
		return View::make('krafthaus/bauhaus::blocks.text')
			->with('content', $this->getArgument('content'));
	}
	
}