<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Sprint */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sprints', 'url' => ['index']];
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
            'project_id',
            'status',
            'start_date',
            'end_date',
            'created_at',
            'updated_at',
            'name',
            'is_del',
        ],
    ]) ?>

</div>
