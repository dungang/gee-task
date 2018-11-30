<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\StoryStatus;
use modules\sprint\models\Story;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\StorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '产品Backlog';
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
                'attribute' => 'story_type',
                'filter' => Story::$types,
                'class' => 'app\grid\FilterColumn'
            ],
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
            [
                'attribute' => 'status',
                'class' => 'app\grid\FilterColumn',
                'filter' => StoryStatus::allIdToName('id', 'name', [
                    'is_backlog' => 1
                ])
            ],
            [
                'label' => '接受项',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('设置', [
                        '/backlog/acceptance/index',
                        'StoryAcceptanceSearch[story_id]' => $model['id']
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
