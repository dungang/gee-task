<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryAcceptance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-acceptance-form">

    <?php $form = ActiveForm::begin(['id'=>'story-acceptance-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'acceptance')->textInput(['maxlength' => true,'id'=>'acceptance']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>
    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'acceptance'
    ]);
    ?>

</div>
