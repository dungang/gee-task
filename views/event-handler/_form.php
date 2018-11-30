<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Event;

/* @var $this yii\web\View */
/* @var $model app\models\EventHandler */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-handler-form">

    <?php $form = ActiveForm::begin(['id'=>'event-handler-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'event_id')->dropDownList(Event::allIdToName()) ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'handler')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
