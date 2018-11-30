<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = '欢迎您';
?>

 <div class="jumbotron">
        <h1>您好! <?= \Yii::$app->user->identity->username?></h1>

        <p class="lead">一个极简的敏捷项目管理系统。</p>
        <p class="lead">一个PMP和ACP的结合的产物，以敏捷为核心却有那么一丁点的传统。</p>
        <p class="lead">只适合小团队，而且负责人可能身兼数职。</p>
        <p>
        	<?= Html::a('添加一个项目',['/project/index'],['class'=>'btn btn-lg btn-success']) ?>
        	<?= Html::a('直接去前台',['/space'],['class'=>'btn btn-lg btn-warning']) ?>
        </p>
    </div>