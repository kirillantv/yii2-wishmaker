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
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<?= Html::a('Add wish', ['create'], ['class' => 'btn btn-primary']); ?>	
			</div>
		</div>
		<br />
		<br />
		<div class="col-xs-12">
			<div class="row">
				<?php foreach ($model as $wish): ?>
				<div class="well well-sm">
					<?= $wish->wish ?>	
				</div>
				<?php endforeach; ?>		
			</div>
		</div>		
	</div>
</div>

