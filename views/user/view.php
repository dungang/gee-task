<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'nick_name',
            'email:email',
            'mobile',
            'is_admin',
            'is_super',
            'role',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    if($model['status']==10){
                        return "激活";
                    }  else {
                        return "未激活";
                    }
                }
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
