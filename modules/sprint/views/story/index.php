<?php
use yii\helpers\Html;
use yii\grid\GridView;
use modules\sprint\models\Sprint;
use app\models\StoryStatus;
use modules\sprint\models\Story;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\StorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$sprint = Sprint::findOne([
    'id' => $searchModel->sprint_id
]);
$this->title = '#'.$searchModel->sprint_id . $sprint->name . '的用户故事';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-index">

	<p>
        <?= Html::a('添加 Story', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model['id'], [
                        'view',
                        'id' => $model['id']
                    ], [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]);
                }
            ],
            'name',
            [
                'attribute' => 'status',
                'class' => 'app\grid\FilterColumn',
                'filter' => StoryStatus::allIdToName('id', 'name', [
                    'is_backlog' => 0
                ])
            ],
            'user_id',

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
