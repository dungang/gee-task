<?php
use yii\helpers\Html;
use yii\grid\GridView;
use modules\sprint\models\Sprint;
use app\models\StoryStatus;
use modules\sprint\models\Story;
use app\models\ProjectMember;
use app\widgets\FixedTableHeader;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\StorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$sprint = Sprint::findOne([
    'id' => $searchModel->sprint_id
]);
$this->title = '#' . $searchModel->sprint_id . $sprint->name . '的用户故事';
$this->params['breadcrumbs'][] = $this->title;
$storyStatuses = StoryStatus::allIdToName('id', 'name', [
    'is_backlog' => 0
]);
?>
<div class="story-index">

	<p>
        <?= Html::a('添加 Story', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php
    $tableWidth = 1140;

    $colWidth = [
        'id' => 65, //编码
        'user_id' => 60, //被指派人
        'name' => 260, //任务名称
        'action' => 100
    ];
    //状态
    $statusWidth = $tableWidth;
    foreach ($colWidth as $col => $width) {
        $statusWidth -= $width;
    }
    if (empty($storyStatuses)) {

        $colWidth['taskName'] += $statusWidth;
    }
    
    $dataProvider->pagination = false;
   

    echo GridView::widget([
        'summary'=>false,
        'headerRowOptions' => [
            'id' => 'fixed-table-header'
        ],
        'options' => [
            'id' => 'task-item-table',
            'class' => 'grid-view'
        ],
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'headerOptions' => [
                    'width' => $colWidth['id'] . 'px',
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'width' => $colWidth['id'] . 'px',
                    'class' => 'text-center'
                ],
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
            [
                'headerOptions' => [
                    'width' => $colWidth['name'] . 'px'
                ],
                'contentOptions' => [
                    'width' => $colWidth['name'] . 'px'
                ],
                'attribute' => 'name'
            ],
            [
                'attribute' => 'status',
                'width' => $statusWidth,
                'class' => 'app\grid\StatusDataColumn',
                'allStatus' => StoryStatus::allIdToName('id', 'name', [
                    'is_backlog' => 0
                ]),
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('<span class="glyphicon glyphicon-ok text-success"></span>', [
                        '/sprint/story-active/create',
                        'StoryActive[old_status]' => $model['status'],
                        'StoryActive[sprint_id]' => $model['sprint_id'],
                        'StoryActive[story_id]' => $model['id']
                    ], [
                        'title' => '请添加操作日志',
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]);
                }
            ],
            [
                'headerOptions' => [
                    'width' => $colWidth['user_id'] . 'px'
                ],
                'contentOptions' => [
                    'width' => $colWidth['user_id'] . 'px'
                ],
                'attribute' => 'user_id',
                'filter'=>ProjectMember::allIdToName('user_id','username',['project_id'=>$searchModel->project_id]),
                'class'=>'app\grid\FilterColumn',
            ],
            [
                'headerOptions' => [
                    'width' => $colWidth['action'] . 'px'
                ],
                'contentOptions' => [
                    'width' => $colWidth['action'] . 'px'
                ],
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
    FixedTableHeader::widget(['options'=>['id'=>'fixed-table-header']]);
    ?>
</div>

