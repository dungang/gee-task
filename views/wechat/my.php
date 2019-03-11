<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Wechats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wechat-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
        <?= Html::a('添加 Wechat', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php
    $dataProvider->pagination = false;
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a($model['name'], [
                        'group',
                        'id' => $model['id']
                    ]);
                }
            ],
            'status',
            'traced_at:datetime',
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
