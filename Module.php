<?php 
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */

namespace kirillantv\wishmaker;

class Module extends \yii\base\Module
{
	public $itemModelClass = null;
	
	public $itemColumn = null;
	
	public $limit = 10;
	
	public function init() 
	{
		parent::init();
	}
	
	public function getRecommendations()
	{
		$wishmaker = new \kirillantv\wishmaker\models\Wishmaker;
		return $wishmaker->recommendations;
	}
}
?>