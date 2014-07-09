<?php

namespace KraftHaus\Bauhaus\Field;

/**
 * This file is part of the KraftHaus Bauhaus package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use KraftHaus\Bauhaus\Field\BaseField;

/**
 * Class MorphManyField
 * @package KraftHaus\Bauhaus\Field
 */
class MorphManyField extends BelongsToManyField
{

	public function postUpdate($input)
	{
		$baseModel = $this->getAdmin()->getModel();
		$baseModel = $baseModel::find($this->getAdmin()->getFormBuilder()->getIdentifier());

		$relatedModel = $baseModel->{$this->getName()}()->getRelated();

		// Image::where('imageable_type', 'Article')->where('imageable_id', $article_id)->delete();

		$morphType  = $baseModel->{$this->getName()}()->getMorphType();
		$foreignKey = $baseModel->{$this->getName()}()->getForeignKey();

		// print_r(get_class($baseModel));

		$relatedModel::where($morphType, get_class($baseModel))->where($foreignKey, $this->getAdmin()->getFormBuilder()->getIdentifier())->delete();

		exit();
	}

}