<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryAcceptance */

$this->title = '添加 Story Acceptance';
$this->params['breadcrumbs'][] = ['label' => 'Story Acceptances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
