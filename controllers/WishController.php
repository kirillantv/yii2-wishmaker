<?php 
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
 
namespace kirillantv\wishmaker\controllers;

use Yii;
use kirillantv\wishmaker\models\Wish;

class WishController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$model =  Wish::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
		return $this->render('index', ['model' => $model]);
	}
	
	public function actionCreate()
	{
		$wish = new Wish();
		
		if ($wish->load(Yii::$app->request->post()) && $wish->validate())
		{
			$wish->save();
			return $this->redirect(['index']);
		}
		else {
			return $this->render('create', ['wish' => $wish]);
		}
	}
}