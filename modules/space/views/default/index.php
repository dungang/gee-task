<?php
use yii\helpers\Html;
use app\widgets\Timeline;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = '项目控制台';
$this->params['breadcrumbs'][] = [
    'label' => 'Projects',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="panel panel-default">
	<div class="panel-body">
		<div id="timeline" class="timeline">
			<div class="timeline__wrap">
<?php
$dataProvider->pagination = false;
$size = count($dataProvider->models);
echo ListView::widget([
    'options' => [
        'class' => 'timeline__items'
    ],
    'dataProvider' => $dataProvider,
    'layout' => '{items}',
    'itemOptions' => [
        'class' => 'timeline__item'
    ],
    'itemView' => function ($model, $key, $index, $widget) {
        return '<div class="timeline__content">
					<div>
						<strong style="font-size: medium;">' . $model->title . '</strong>
					</div>
					' . $model->description . '
				</div>';
    }
])?>
			</div>
		</div>
	</div>
</div>

<p class="text-center" style="margin-top: 60px;">
        <?= Html::a('添加 Timeline', ['create'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>
<?php Timeline::widget(['id'=>'timeline','size'=>$size])?>
