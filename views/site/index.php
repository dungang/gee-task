<?php
use yii\helpers\Html;
use app\widgets\GiteeProjectCommits;

/* @var $this yii\web\View */
$this->title = '欢迎您';
?>

<div class="jumbotron">
	<h1>您好! <?= \Yii::$app->user->identity->username?></h1>
	<p>
        	<?= Html::a('添加一个项目',['/project/index'],['class'=>'btn btn-lg btn-success']) ?>
        	<?= Html::a('直接去控制台',['/space'],['class'=>'btn btn-lg btn-warning']) ?>
        </p>
</div>
<div class="jumbotron">

	<h2>敏捷宣言</h2>
	<p class="lead">个体和互动高于流程和工具 ，可工作软件高于详尽的文档</p>
	<p class="lead">客户合作高于合同谈判 ， 响应变化高于遵循计划</p>
</div>

<div class="col-md-6 col-md-offset-3">
	<h2 class="text-center">GeeTask 最新动态</h2>
	<?php echo GiteeProjectCommits::widget()?>
</div>