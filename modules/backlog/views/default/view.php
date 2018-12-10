<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use modules\sprint\models\StoryAcceptance;
use modules\sprint\models\Story;
use app\models\StoryStatus;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model modules\sprint\models\Story */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'Stories',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
$users = User::allIdToName('id', 'nick_name');
?>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h4 class="modal-title">#<?= Html::encode($model->id) ?></h4>
</div>
<div class="modal-body row">

	<div class="col-md-12">
		<blockquote>
		<?php echo $model->name?>
	</blockquote>
	<?php
$acceptances = StoryAcceptance::find()->where([
    'story_id' => $model->id
])->all();
foreach($acceptances as $acceptance){
    echo "<p>".$acceptance->acceptance."</p>";
}
?>
	</div>

	<div class="col-md-6">
	<?php

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'project_version',
        [
            'attribute' => 'story_type',
            'value' => function ($model) {
                return Story::$types[$model->story_type];
            }
        ],
        [
            'attribute' => 'status',
            'value' => function ($model) {
                $status = StoryStatus::allIdToName();
                return $status[$model->status];
            }
        ],
        'important',
        'points'
    ]
])?>
	</div>
	<div class="col-md-6">
	<?php

echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'last_user_id',
            'value' => function ($model) use ($users) {
                return $model->last_user_id ? $users[$model->last_user_id] : $model->last_user_id;
            }
        ],
        [
            'attribute' => 'creator_id',
            'value' => function ($model) use ($users) {
                return $model->creator_id ? $users[$model->creator_id] : $model->creator_id;
            }
        ],
        'created_at:date',
        'updated_at:date',
        'is_del'
    ]
])?>
	</div>

</div>
