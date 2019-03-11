<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Wechat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Wechats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'user_id',
                'value'=>function($model){
                    $users = User::allIdToName('id','nick_name');
                    return isset($users[$model->user_id])?$users[$model->user_id]:null;
                }
            ],
            'name',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            'traced_at:datetime',
            'data:ntext',
        ],
    ]) ?>

</div>
