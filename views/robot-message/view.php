<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RobotMessage */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '机器人消息模板', 'url' => ['index']];
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
            'code',
            'name',
            'msg_subject',
            'subject_vars',
            'msg_body:ntext',
            'body_vars',
        ],
    ]) ?>

</div>
