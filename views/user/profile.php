<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = '用户中心';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?php $form = ActiveForm::begin(['id'=>'profile-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'username')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'nick_name')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'mobile')->textInput() ?>
    <?=$form->field($model, 'status')->hiddenInput()->label(false)?>

    <div class="form-group">
        <?= Html::submitButton('更新', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
