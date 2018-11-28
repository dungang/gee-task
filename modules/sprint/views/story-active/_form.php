<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StoryStatus;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryActive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-active-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'old_status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>0])) ?>

    <?= $form->field($model, 'new_status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>0])) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
