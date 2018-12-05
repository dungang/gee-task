<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model app\models\RobotMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="robot-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msg_subject')->textInput(['maxlength' => true,'id'=>'msg-subject']) ?>

    <?= $form->field($model, 'subject_vars')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msg_body')->textarea(['rows' => 6,'id'=>'msg-body']) ?>

    <?= $form->field($model, 'body_vars')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'msg-subject'
    ]);
    EmojiOneArea::widget([
        'id' => 'msg-body'
    ]);
    ?>

</div>
