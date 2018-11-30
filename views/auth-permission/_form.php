<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AuthRule;

/* @var $this yii\web\View */
/* @var $model app\models\AuthPermission */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-permission-form">

    <?php $form = ActiveForm::begin(['id'=>'auth-permission-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'child')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'rule_name')->dropDownList(AuthRule::allIdToName('name','name'),['prompt'=>'']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
