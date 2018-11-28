<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthRule */

$this->title = '更新验证规则: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '验证规则', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
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
