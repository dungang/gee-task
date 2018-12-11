<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel  app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '事件';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?= Html::a('添加事件', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'code',
            [
                'label' => '处理器',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('设置', [
                        '/event-handler/index',
                        'EventHandlerSearch[event_id]' => $model['id']
                    ]);
                }
            ],
            [
                'class' => '\app\grid\ActionColumn',
                'buttonsOptions' => [
                    'update' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ],
                    'view' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]
                ]
            ]
        ]
    ]);
    ?>
</div>
