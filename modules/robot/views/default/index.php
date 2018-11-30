<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Robot;

/* @var $this yii\web\View */
/* @var $searchModel modules\robot\models\ProjectRobotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '机器人';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->pagination = false;
?>
<div class="project-robot-index">

    <p>
        <?= Html::a('添加 Project Robot', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>
	
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>false,
        'columns' => [
            'name',
            [
                'attribute'=>'robot_id',
                'filter'=>Robot::allIdToName(),
                'class'=>'app\grid\FilterColumn',
            ],
            'webhook',
            [
                'class' => '\app\grid\ActionColumn',
                'buttonsOptions'=>[
                    'update'=>[
                        'data-toggle'=>'modal',
                        'data-target'=>'#modal-dailog',
                    ],
                    'view'=>[
                        'data-toggle'=>'modal',
                        'data-target'=>'#modal-dailog',
                    ],
                ]
        	]
       ]
    ]); ?>
</div>
