<?php
use yii\widgets\DetailView;
use modules\sprint\models\Story;
use app\models\StoryStatus;

/* @var $model \modules\sprint\models\Story */
/* @var $users []|\app\models\User[] */

?>
<br />
<div class="row">
	<div class="col-md-6">
	<?php

echo DetailView::widget([
    'model' => $model,
    'options'=>['class' => 'table table-bordered detail-view'],
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
    'options'=>['class' => 'table table-bordered detail-view'],
    'attributes' => [
        [
            'attribute' => 'user_id',
            'value' => function ($model) use ($users) {
                return isset($users[$model->user_id]) ? $users[$model->user_id] : '未指定';
            }
        ],
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