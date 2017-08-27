<?php 
/**
 * This file is part of Yii2-Wishmaker project
 * (c) kirillantv <http://github.com/kirillantv/>
 * 
 * For more information read README and LICENSE file 
 */
use yii\helpers\Html;
?>
<div class="col-xs-12">
	<?= Html::a('Add wish', ['create'], ['class' => 'btn btn-primary']); ?>
</div>
<?php foreach ($model as $wish): ?>
<span class="well">
	<?= $wish->wish ?>	
</span>
<?php endforeach; ?>