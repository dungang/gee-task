<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\SprintSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sprints';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sprint-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加 Sprint', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'format'=>'raw',
                'value'=>function($model,$key,$index,$column){
                    return Html::a($model['id'],['view','id'=>$model['id']],['data-toggle'=>'modal','data-target'=>'#modal-dailog']);
                }
        	],
            'project_id',
            'status',
            'start_date',
            'end_date',
            //'created_at',
            //'updated_at',
            //'name',
            //'is_del',

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
