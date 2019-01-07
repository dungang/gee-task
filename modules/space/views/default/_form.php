<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\DatePicker;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model modules\space\models\Timeline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timeline-form">

    <?php $form = ActiveForm::begin(['id'=>'timeline-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'title')->widget(DatePicker::className()) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true,'id'=>'timeline-description']) ?>

    <div class="form-group">
        <?php

        echo $model->isNewRecord ? '' : Html::a('删除', [
            'delete',
            'id' => $model->id
        ], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post'
            ]
        ])?>
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'timeline-description'
    ]);
    ?>

</div>
