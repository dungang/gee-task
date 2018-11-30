<?php
use yii\helpers\Html;
use yii\grid\GridView;
use modules\sprint\models\Story;
use app\helpers\MiscHelper;

/* @var $this yii\web\View */
/* @var $searchModel modules\sprint\models\StoryAcceptanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$story = Story::findOne([
    'id' => $searchModel->story_id
]);
$this->title = '用户故事#' . $story->id . $story->name . '的接受项';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="story-acceptance-index">

	<p>
		<?= MiscHelper::goBackButton()?>
        <?= Html::a('添加 Story Acceptance', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>

    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'acceptance',
            'created_at:date',
            [
                'class' => '\app\grid\ActionColumn',
                'buttonsOptions' => [
                    'update' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ],
                    'view' => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal-dailog'
                    ]
                ]
            ]
        ]
    ]);
    ?>
</div>
