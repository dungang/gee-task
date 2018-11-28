<?php

/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<div class="row">
	<div class="col-md-3">
		<h1><i class="glyphicon glyphicon-user"></i> <?= \Yii::$app->user->identity->username?></h1>
	</div>
	<div class="col-md-9">
		
	</div>
</div>
