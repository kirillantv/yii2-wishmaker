<?php
/**
 * This file is part of Yii2-Swap project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
 
namespace kirillantv\wishmaker\models;

use Yii;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "{{%wish}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $wish
 *
 * @property User $user
 */
class Wish extends \yii\db\ActiveRecord
{
	public static function tableName()
	{
		return '{{%wish}}';
	}
	
	public function behaviors()
	{
		return [
			[
				'class' => BlameableBehavior::classname(),
				'createdByAttribute' => 'user_id',
				'updatedByAttribute' => false
				]
			];
	}
	
	public function rules()
	{
		return [
			[['wish'], 'required'],
			[['wish'], 'string', 'max' => 255]
			];
	}
	
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User',
			'wish' => 'Wish'
			];
	}
	
	public function getUser()
	{
		return $this->hasOne(Yii::$app->user->identityClass, ['id' => 'user_id']);
	}
}
