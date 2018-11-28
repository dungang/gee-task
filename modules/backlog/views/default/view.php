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
		<h4 class="modal-title"><?= Html::encode($this->title) ?></h4>
</div>
<div class="modal-body">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sprint_id',
            'story_type',
            'status',
            'important',
            'project_id',
            'user_id',
            'last_user_id',
            'creator_id',
            'created_at',
            'updated_at',
            'name',
            'project_version',
            'is_del',
        ],
    ]) ?>

</div>
