<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['id'=>'myproject-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'id'=>'project-name']) ?>

    <?= $form->field($model, 'web_site')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'project-name'
    ]);
    ?>

</div>
