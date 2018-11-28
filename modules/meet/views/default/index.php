<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\meet\models\MeetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会议';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meet-index">

    <p>
        <?= Html::a('添加 Meet', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            
            [
                'attribute'=>'meet_date',
                'format'=>'date',
                'class'=>'app\grid\DateTimeColumn',
            ],
            [
                'attribute' => 'title',
                'format'=>'raw',
                'value'=>function($model,$key,$index,$column){
                    return Html::a($model['title'],['view','id'=>$model['id']],['data-toggle'=>'modal','data-target'=>'#modal-dailog']);
                }
        	],
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
