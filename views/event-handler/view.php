<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Event;

/* @var $this yii\web\View */
/* @var $model app\models\EventHandler */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => '事件处理器',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
$event = Event::findOne([
    'id' => $model->event_id
]);
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?php

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'event_id',
                'value' => function ($model) use ($event) {
                    return $event->name;
                }
            ],
            'handler',
            'intro',
            'created_at:date',
            'updated_at:date'
        ]
    ])?>

</div>
