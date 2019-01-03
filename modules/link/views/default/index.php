<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\link\models\LinkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '常用链接';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">
    <p>
        <?= Html::a('添加 Link', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'label',
                'format'=>'raw',
                'value'=>function($model,$key,$index,$column){
                    return Html::a($model['label'],['view','id'=>$model['id']],['data-toggle'=>'modal','data-target'=>'#modal-dailog']);
                }
        	],
            [
                'attribute'=>'url',
                'format'=>'raw',
                'value'=>function($model,$key,$index,$column){
                    return Html::a($model['url'],$model['url'],['target'=>'_blank']);
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
