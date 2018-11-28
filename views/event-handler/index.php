<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Event;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventHandlerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Handlers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-handler-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('添加 Event Handler', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'event_id',
                'filter'=>Event::allIdToName(),
                'class'=>'app\grid\FilterColumn'
            ],
            'name',
            'handler',
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
