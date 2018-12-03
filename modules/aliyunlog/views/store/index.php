<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\helpers\MiscHelper;
/* @var $this yii\web\View */
/* @var $model modules\aliyunlog\models\LogStore */
$this->title = "日志库";
$this->params['breadcrumbs'][] = [
    'label' => '日志项目',
    'url' => [
        '/aliyun-log-project/index'
    ]
];
$projectName = \Yii::$app->request->get('projectName');
$this->params['breadcrumbs'][] = \Yii::$app->request->get('projectName');
$this->params['breadcrumbs'][] = $this->title;

$this->title = $projectName .  "日志";
?>
<p><?= MiscHelper::goBackButton()?></p>
<div class="logstore">
	    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'logstoreName',
            [
                'label' => '日志库日志',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('查看', [
                        '/aliyun-log/info/index',
                        'LogSearch[projectName]' => $model['projectName'],
                        'LogSearch[logstoreName]' => $model['logstoreName']
                    ]);
                }
            ],
            [
                'label' => '项目日志',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('查看', [
                        '/aliyun-log/info/project-log',
                        'ProjectLogSearch[projectName]' => $model['projectName'],
                        'ProjectLogSearch[logstoreName]' => $model['logstoreName']
                    ]);
                }
            ]
        ]
    ]);
    ?>
</div>