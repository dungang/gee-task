<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"
		aria-hidden="true">&times;</button>
		<h4 class="modal-title">#<?= Html::encode($model->id) ?></h4>
</div>
<div class="modal-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'project_version',
            'story_type',
            'status',
            'important',
            'points',
            'user_id',
            'last_user_id',
            'creator_id',
            'created_at:date',
            'updated_at:date',
            'is_del',
        ],
    ]) ?>

</div>
