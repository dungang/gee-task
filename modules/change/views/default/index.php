<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ChangeCategory;

/* @var $this yii\web\View */
/* @var $searchModel modules\change\models\ChangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '变更';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="change-index">

    <p>
        <?= Html::a('添加 Change', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'created_at',
                'format'=>'date',
                'class'=>'app\grid\DateTimeColumn'
            ],
            [
                'attribute'=>'category_id',
                'filter'=>ChangeCategory::allIdToName(),
                'class'=>'app\grid\FilterColumn',
            ],
            [
                'attribute'=>'content',
                'format'=>'html',
                'value'=>function($model){
                    return '<pre style="width:750px;overflow-x:hidden;">'.$model->content.'</pre>';
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
