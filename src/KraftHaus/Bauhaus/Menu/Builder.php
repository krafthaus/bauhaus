<?php

namespace KraftHaus\Bauhaus\Menu;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

/**
 * Class Builder
 * @package KraftHaus\Bauhaus\Menu
 */
class Builder
{

	/**
	 * Holds the menu items.
	 * @var array
	 */
	protected $items = ['left' => [], 'right' => []];

	/**
	 * Public class constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$this->items['left'] = Config::get('bauhaus::admin.menu');
	}

	/**
	 * Add new items to the menu array.
	 * 
	 * @param  array $menu
	 *
	 * @access public
	 * @return Builder
	 */
	public function addMenu($position, array $menu)
	{
		array_push($this->items[$position], $menu);
		return $this;
	}

	/**
	 * Build the menu html.
	 *
	 * @access public
	 * @return string
	 */
	public function build()
	{
		$menu = $this->items;

		$html = '';

		if (isset($menu['right'])) {
			$html.= '<ul class="nav navbar-nav navbar-right">';
			$html.= $this->buildMenu($menu['right']);
			$html.= '</ul>';
		}

		$html.= '<ul class="nav navbar-nav">';
		$html.= sprintf('<li><a href="%s">Dashboard</a></li>', route('admin.dashboard'));
		$html.= $this->buildMenu($menu['left']);
		$html.= '</ul>';

		return $html;
	}

	/**
	 * Iterator method for the build() function.
	 * 
	 * @param  array $menu
	 *
	 * @access public
	 * @return string
	 */
	private function buildMenu($menu)
	{
		$html = '';

		foreach ($menu as $value) {
			$icon = '';
			if (isset($value['icon'])) {
				$icon = sprintf('<i class="fa fa-%s"></i> ', $value['icon']);
			}

			if (isset($value['children'])) {
				$html.= '<li class="dropdown">';
				$html.= sprintf('<a href="#" class="dropdown-toggle" data-toggle="dropdown">%s%s<b class="caret"></b></a>', $icon, $value['title']);
				$html.= '<ul class="dropdown-menu">';
				$html.= $this->buildMenu($value['children']);
				$html.= '</ul>';
				$html.= '</li>';

				continue;
			}

			$url = '';

			if (isset($value['class'])) {
				$url = route('admin.model.index', urlencode($value['class']));
			} elseif (isset($value['url'])) {
				$url = $value['url'];
			}

			if (isset($value['text'])) {
				$html.= sprintf('<li><p class="navbar-text">%s</p></li>', $value['text']);
			} elseif (isset($value['image'])) {
				$html.= sprintf('<li><img src="%s" class="navbar-image"></li>', $value['image']);
			} else {
				$html.= sprintf('<li><a href="%s">%s%s</a></li>', $url, $icon, $value['title']);
			}
		}

		return $html;
	}


}