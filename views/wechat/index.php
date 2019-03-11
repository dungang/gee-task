<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Setting;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WechatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wechats';
$this->params['breadcrumbs'][] = $this->title;
$status = Setting::findOne([
    'name' => 'wechat.loop.status'
]);
if (! $status) {
    $status = new Setting([
        'name' => 'wechat.loop.status',
        'title' => '微信后台服务状态'
    ]);
    $status->save(false);
}
$trace = Setting::findOne([
    'name' => 'wechat.loop.traced_at'
]);

if (! $trace) {
    $trace = new Setting([
        'name' => 'wechat.loop.traced_at',
        'title' => '微信后台服务最后执行时间'
    ]);
    $trace->save(false);
}
;
?>
<div class="wechat-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<div class="panel panel-default">
		<div class="panel-body">
			<p><strong>微信服务运行状态: </strong>
		<?= intval($status->value) > 0 ? Html::a('运行中 ... ',['switch-service'],['class'=>'btn btn-success btn-sm','id'=>'switch-service']) :  Html::a('已停止 ',['switch-service'],['class'=>'btn btn-danger btn-sm','id'=>'switch-service']) ?></p>
			<p>开启执行：<?= \Yii::$app->formatter->asDatetime($status->value)?></p> 
			<p>最后执行：<?= \Yii::$app->formatter->asDatetime($trace->value)?></p>
		</div>
	</div>
    <?php
    $dataProvider->pagination = false;
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'status',
            'traced_at:datetime'
        ]
    ]);
    ?>
</div>

<?php
$url = Url::to([
    'loop'
]);
$this->registerJs("$.get('${url}');");
?>
