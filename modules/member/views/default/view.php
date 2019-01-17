<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectMember */

$this->title = '查看成员';
$this->params['breadcrumbs'][] = ['label' => 'Project Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user = User::findOne(['id'=>$model->user_id]);
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?php echo DetailView::widget([
        'model' => $user,
        'attributes' => [
            'username',
            'nick_name',
            'email:email',
            'mobile',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
