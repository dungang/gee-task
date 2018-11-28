<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ChangeCategory;

/* @var $this yii\web\View */
/* @var $model modules\change\models\Change */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="change-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ChangeCategory::allIdToName()) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
