<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model modules\meet\models\Meet */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => '会议',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
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
            'title',
            'meet_date',
            [
                'attribute' => 'creator_id',
                'value' => function ($model, $widget) {
                    $user = User::findOne([
                        'id' => $model->creator_id
                    ]);
                    return empty($user) ?  '未设置' : $user->nick_name;
                }
            ],
            'actors:ntext',
            'content:html',
            'created_at:datetime',
            'updated_at:datetime'
        ]
    ])?>

</div>
