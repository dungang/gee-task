<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectMember */
/* @var $form yii\widgets\ActiveForm */
/* @var $this yii\web\View */
/* @var $model app\models\ProjectMember */

$this->title = '设置参数';
$this->params['breadcrumbs'][] = ['label' => '阿里云日志', 'url' => ['index']];
$this->params['breadcrumbs'][] = '设置';
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
<div class="aliyun-log-form">

    <?php $form = ActiveForm::begin(['id'=>'project-member-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'endpoint')->textInput() ?>

    <?= $form->field($model, 'access_key')->textInput()?>
    
    <?= $form->field($model, 'secret_key')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
