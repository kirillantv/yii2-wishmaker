<?php
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>
<?= Html::activeTextInput($wish, 'wish', [
				'class' => 'form-control', 
				'style' => 'margin-bottom:10px'])?>
<?= Html::submitButton('Add to wishlist', ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>