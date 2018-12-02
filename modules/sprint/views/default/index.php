<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\SprintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '迭代';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-index">

	<p>
        <?= Html::a('添加 Sprint', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'headerOptions' => [
                    'width' => '80px'
                ],
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('#'.$model['id'], [
                        'view',
                        'id' => $model['id']
                    ], [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]);
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model->name, [
                        '/sprint/story/index',
                        'StorySearch[sprint_id]' => $model['id']
                    ]);
                }
            ],
            'status',
            [
                'attribute' => 'start_date',
                'class' => 'app\grid\DatetimeColumn',
                'format' => 'date'
            ],
            [
                'attribute' => 'end_date',
                'class' => 'app\grid\DatetimeColumn',
                'format' => 'date'
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
