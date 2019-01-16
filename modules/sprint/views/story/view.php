<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use modules\sprint\models\StoryAcceptance;
use modules\sprint\models\Story;
use app\models\StoryStatus;
use app\models\User;
use modules\sprint\models\StoryActive;
use yii\bootstrap\Tabs;

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
<div class="modal-body">
	<blockquote> <?php echo $model->name?> </blockquote>
	<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => '信息',
            'content' => $this->render('_view', [
                'model' => $model,
                'users' => $users
            ]),
            'active' => true
        ],
        [
            'label' => '验收',
            'content' => $this->render('_acceptance', [
                'model' => $model,
            ]),
        ],
        [
            'label' => '记录',
            'content' => $this->render('_activity', [
                'model' => $model,
                'users' => $users
            ]),
        ]
    ]
]);
?>

</div>
