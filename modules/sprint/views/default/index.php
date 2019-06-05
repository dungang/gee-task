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
        <?= Html::a('添加 Sprint', ['create'], ['class' => 'btn btn-success', 'data-toggle' => 'modal', 'data-target' => '#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => '迭代',
                'attribute'=>'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) use ($dataProvider) {
                    $pagination = $dataProvider->getPagination();
                    $count = $dataProvider->getTotalCount();
                    if ($pagination !== false) {
                        $idx = $pagination->getOffset() + $index;
                    } else {
                        $idx = $index;
                    }
                    $times = $count - $idx;
                    return Html::a('#' . $times . ' ' . $model->name, [
                        '/sprint/story/index',
                        'StorySearch[sprint_id]' => $model['id'],
                        'sprint_times' => $times
                    ]);
                }
            ],
            'status',
            [
                'attribute' => 'start_date',
                'class' => 'app\grid\DateTimeColumn',
                'format' => 'date'
            ],
            [
                'attribute' => 'end_date',
                'class' => 'app\grid\DateTimeColumn',
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