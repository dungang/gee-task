<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AppModuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统模块';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-module-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加模块', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'name',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $column){
                    return Html::a($model['name'],['/'.$model['name']],['data-pjax'=>'0']);
                }
            ],
            'description:ntext',
            'created_at:date',
            [
                'label'=>'路由',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $column){
                    return Html::a('查看',['/ac-route','parent'=>$model['name'],'title'=>$model['description']],['data-pjax' => '0',]);
                }
            ],
            [
                'label'=>'权限',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $column){
                    return Html::a('查看',['/auth-permission','parent'=>$model['name'],'title'=>$model['description']],['data-pjax' => '0',]);
                }
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
        ],
    ]); ?>
</div>