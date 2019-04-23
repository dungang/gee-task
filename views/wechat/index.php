<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\helpers\CrontabHelpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wechats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<div class="well">
    <?php list ($cron_status, $cron_traced_at) = CrontabHelpers::prepareCronSetting();?>
    <p>
		<strong>服务运行状态: </strong>
    <?php

    echo intval($cron_status) > 0 ? '<span class="btn btn-xs btn-success">运行中 ... </span> ' . Html::a('<i class="fa  fa-stop"></i> 停止', [
        'switch-service'
    ], [
        'class' => 'btn btn-default btn-xs',
        'id' => 'switch-service',
        'data-pjax' => '0'
    ]) : '<span class="btn btn-xs btn-warning">已停止 </span> ' . Html::a('<i class="fa fa-play-circle"></i> 启动', [
        'switch-service'
    ], [
        'class' => 'btn btn-default btn-xs',
        'id' => 'switch-service',
        'data-pjax' => '0'
    ])?></p>
	<p>服务启动时间：<?= \Yii::$app->formatter->asDatetime($cron_status)?></p>
	<p>最后执行时间：<?= \Yii::$app->formatter->asDatetime($cron_traced_at)?></p>
</div>
    <?php
    $dataProvider->pagination = false;
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'status',
            'traced_at:datetime'
        ]
    ]);
    ?>
</div>

<?php
$url = Url::to([
    'loop'
]);
$this->registerJs("$.get('${url}');");
?>
