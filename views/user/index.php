<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Role;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

	<h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('添加用户', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'username',
                'headerOptions' => [
                    'width' => '100px'
                ]
            ],
            [
                'attribute' => 'nick_name',
                'headerOptions' => [
                    'width' => '100px'
                ]
            ],
            [
                'attribute'=>'role',
                'filter'=>Role::allIdToName('name','name',['scope'=>'ADMIN']),
                'class' => 'app\grid\FilterColumn',
                
            ],
            'email:email',
            [
                'attribute' => 'mobile',
                'headerOptions' => [
                    'width' => '110px'
                ]
            ],
            [
                'attribute' => 'is_admin',
                'headerOptions' => [
                    'width' => '80px'
                ],
                'class' => 'app\grid\BoolColumn',
            ],
            [
                'attribute' => 'is_super',
                'headerOptions' => [
                    'width' => '80px'
                ],
                'class' => 'app\grid\BoolColumn',
            ],
            [
                'attribute' => 'status',
                'headerOptions' => [
                    'width' => '120px'
                ],
                'filter' => [
                    0 => "<span class='text-danger'>未激活</span>",
                    10 => "<span class='text-success'>已激活</span>"
                ],
                'class' => 'app\grid\FilterColumn',
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'headerOptions' => [
                    'width' => '120px'
                ],
                'class'=>'app\grid\DateTimeColumn'
            ],

            [
                'class' => 'app\grid\ActionColumn',
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
