<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\DatePicker;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Sprint */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sprint-form">

    <?php $form = ActiveForm::begin(['id'=>'sprint-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'id'=>'sprint-name']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'todo' => 'Todo', 'doing' => 'Doing', 'done' => 'Done', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::className())  ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>
    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'sprint-name'
    ]);
    ?>

</div>
