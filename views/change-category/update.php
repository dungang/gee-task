<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChangeCategory */

$this->title = '编辑变更类别: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '变更类别', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
