<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Robot;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model modules\robot\models\ProjectRobot */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-robot-form">

    <?php $form = ActiveForm::begin(['id'=>'project-robot-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'robot_id')->dropDownList(Robot::allIdToName()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'id'=>'robot-name']) ?>

    <?= $form->field($model, 'webhook')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'robot-name'
    ]);
    ?>

</div>
