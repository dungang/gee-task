<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\sprint\models\Story;
use app\models\StoryStatus;
use app\models\ProjectMember;
use app\widgets\EmojiOneArea;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="story-form">
    <?php $form = ActiveForm::begin(['id'=>'story-form','enableAjaxValidation' => true]); ?>
	<div class="row">
		<div class="col-md-12">
			<?= $form->field($model, 'story_type')->radioList(Story::$types) ?>
    		<?= $form->field($model, 'name')->textInput(['maxlength' => true,'id'=>'story-name']) ?>
		</div>
		<div class="col-md-6">
    		<?= $form->field($model, 'sprint_id')->textInput() ?>
    		<?php if($model->isNewRecord)  echo $form->field($model, 'status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>0])) ?>
		</div>
		<div class="col-md-6">
    		<?= $form->field($model, 'project_version')->textInput(['maxlength' => true]) ?>
    		<?php if($model->isNewRecord) echo $form->field($model, 'user_id')->dropDownList(ProjectMember::allIdToName('user_id','username')) ?>
		</div>
	</div>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'story-name'
    ]);
    ?>

</div>
