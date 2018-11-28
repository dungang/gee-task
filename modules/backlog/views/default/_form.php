<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\sprint\models\Story;
use app\models\StoryStatus;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'story_type')->radioList(Story::$types) ?>

    <?= $form->field($model, 'status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>1])) ?>

    <?= $form->field($model, 'important')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_version')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
