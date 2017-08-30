<?php
/**
 * This file is part of Yii2-Wismaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
 
namespace kirillantv\wishmaker\models;

use Yii;
use yii\web\NotFoundHttpException;

class Wishmaker extends \yii\base\Model
{
	const OR_LIKE = 'or like';
	
	const LIKE = 'like';
	
	public $user = null;
	
	public $query = null;
	
	public $column = null;
	
	public $limit = null;
	
	public function init()
	{
		parent::init();
		
		if ($this->user == null)
		{
			$this->user = Yii::$app->user->identity->id;
		}
		if ($this->column == null)
		{
			$this->column = Yii::$app->controller->module->itemColumn;
		}		
		if ($this->query == null)
		{
			$itemClass = new Yii::$app->controller->module->itemModelClass;
			$this->query = $itemClass::find()->active()->where([$this->column => '']);
		}
		if ($this->limit == null)
		{
			$this->limit = Yii::$app->controller->module->limit;
		}

	}
	
	public function getUserWishes($user = null)
	{
		if ($user == null)
		{
			$user = $this->user;
		}
		
		$wishlist = Wish::find()->user($user)->all();
		
		if ($wishlist)
		{
			return $wishlist;
		}
		
		else 
		{
			throw new NotFoundHttpException('No wish found');
		}
	}
	
	public function getSearchArray()
	{
		$wishlist = $this->userWishes;
		$conditions = [];
		foreach ($wishlist as $wish)
		{
			$explodedWish = explode(' ', $wish->wish);
			$newWish = [];
			foreach ($explodedWish as $subwish)
			{
				if (strlen($subwish) > 3)
				{
					$newWish[] = $subwish;
				}
			}
			$conditions[] = $newWish;
		}
		
		return $conditions;
	}
	
	public function setConditions()
	{
		$conditions = $this->searchArray;
		foreach ($conditions as $condition)
		{
			$this->andLike($condition);
		}
		
		if ($this->query->count() < $this->limit)
		{
			$this->orLike($condition);
		}
		
		return $this->query->all();
	}
	
	public function getRecommendations()
	{
		return $this->setConditions();
	}
	
	public function orLike($condition)
	{
		$this->query = $this->query->orWhere([Wishmaker::OR_LIKE, $this->column, $condition]);
	}
	
	public function andLike($condition)
	{
		$this->query = $this->query->orWhere([Wishmaker::LIKE, $this->column, $condition]);
	}
}