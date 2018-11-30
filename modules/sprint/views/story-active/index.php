<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\StoryActiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Story Actives';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-active-index">

    <p>
        <?= Html::a('添加 Story Active', ['create','StoryActive[story_id]'=>$searchModel->story_id,'StoryActive[sprint_id]'=>$searchModel->sprint_id], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
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
            'story_id',
            'old_status',
            'new_status',
            'creator_id',
            //'created_at',
            //'remark',

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
