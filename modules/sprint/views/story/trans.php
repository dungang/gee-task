<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\sprint\models\Story;
use app\models\StoryStatus;
use app\widgets\EmojiOneArea;
use modules\sprint\models\Sprint;
use app\helpers\MiscHelper;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */
/* @var $form yii\widgets\ActiveForm */

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */

$this->title = '转移到产品Backlog: #' . $model->id;
$this->params['breadcrumbs'][] = [
    'label' => 'Stories',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->name,
    'url' => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = '转移';
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
	<div class="story-form">

    <?php $form = ActiveForm::begin(['id'=>'backlog-story-form','enableAjaxValidation' => true]); ?>
	<?= Html::activeHiddenInput($model,'spring_id',array('value'=>0)) ?>
    <?= $form->field($model, 'status')->dropDownList(StoryStatus::allIdToName('id','name',['is_backlog'=>1])) ?>

    <div class="form-group">
        <?= Html::submitButton('转移', ['class' => 'btn btn-success']) ?>
    </div>
    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'story-name'
    ]);
    ?>

</div>

</div>
