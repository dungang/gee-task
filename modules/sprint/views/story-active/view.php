<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\StoryActive */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Story Actives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'story_id',
            'old_status',
            'new_status',
            'creator_id',
            'created_at',
            'remark',
        ],
    ]) ?>

</div>
