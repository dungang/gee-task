<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\meet\models\Meet */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Meets', 'url' => ['index']];
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
            'title',
            'meet_date',
            'actors:ntext',
            'content:html',
            'created_at:datetime',
            'updated_at:datetime',
            'creator_id',
            'is_del',
        ],
    ]) ?>

</div>
