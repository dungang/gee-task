<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryActive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-active-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'story_id')->textInput() ?>

    <?= $form->field($model, 'old_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creator_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
