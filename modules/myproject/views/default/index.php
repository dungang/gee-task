<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\myproject\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '我创建的项目';
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->pagination = false;

?>
<div class="project-index">

	<p>
        <?= Html::a('添加 Project', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'summary' => false,
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model['name'], [
                        '/switch-project',
                        'id' => $model['id']
                    ]);
                }
            ],
            'web_site',
            [
                'attribute' => 'is_achived',
                'class' => 'app\grid\BoolColumn'
            ],
            'created_at:date',
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
