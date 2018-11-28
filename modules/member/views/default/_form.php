<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Role;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectMember */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-member-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(User::allIdToName('id','username')) ?>

    <?= $form->field($model, 'position')->radioList(Role::allIdToName('name','name',['scope'=>'POSITION']))?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
