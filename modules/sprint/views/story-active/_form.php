<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StoryStatus;
use app\widgets\EmojiOneArea;
use app\models\ProjectMember;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryActive */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-active-form">

    <?php $form = ActiveForm::begin(['id'=>'story-active-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'new_status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>0]),['value' => $model->old_status ]) ?>
    
    <?= $form->field($model, 'new_user')->dropDownList(ProjectMember::onePrjectMemIdNames(),['value' => $model->old_user ]) ?>

    <?= $form->field($model, 'remark')->textarea(['maxlength' => true,'id'=>'story-active-remark']) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); 
    EmojiOneArea::widget(['id'=>'story-active-remark']);
    ?>
	
</div>
