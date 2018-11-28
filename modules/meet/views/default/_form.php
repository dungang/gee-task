<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model modules\meet\models\Meet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'meet_date')->widget(DatePicker::className()) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'actors')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
