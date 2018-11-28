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
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model['name'], [
                        'view',
                        'id' => $model['id']
                    ], [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
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
                'label' => '故事',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('查看', [
                        '/sprint/story/index',
                        'StorySearch[sprint_id]' => $model['id']
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
