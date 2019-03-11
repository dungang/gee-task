<?php
use yii\helpers\Html;
use app\webchat\Api;
use yii\helpers\Url;
use app\widgets\LongPoll;
use yii\web\JsExpression;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model app\models\Wechat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = [
    'label' => 'Wechats',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1 class="page-header"><?= Html::encode($this->title) ?></h1>
<div class="row">
	<div class="col-md-3">
		<table class="table table-bordered">
			<tr>
				<th width="60">微信</th>
				<td><?= $model->name ?></td>
			</tr>
			<tr>
				<th>状态</th>
				<td><?= $model->status ?></td>
			</tr>
			<tr>
				<th>追踪</th>
				<td><?= date('Y-m-d',$model->traced_at )?></td>
			</tr>
		</table>
<?php
if ($model->status == 'STOP') :
    $api = new Api();
    $uuid = $api->getUuid();
    $url = Url::to([
        '/wechat/login-check',
        'tip' => 0,
        'uuid' => $uuid,
        'id'=>$model->id,
    ]);
    echo Html::tag('h4','扫描登录');
    echo Html::img([
        '/wechat/qr',
        'uuid' => $uuid
    ], [
        'class' => 'img-thumbnail',
        'id' => 'login-scan'
    ]);
    LongPoll::widget([
        'id' => 'login-scan',
        'clientOptions' => [
            'url' => $url,
            'dataType' => 'json',
            'onSuccess' => new JsExpression("function(data){
            this.data('timestamp',data.timestamp);
            console.log(data);
            if(data.user){
                window.loaction.refresh();
            }
        }")
        ]
    ]);
endif;

$api = new Api();
$data = Json::decode($model->data);
$rooms = [];
if(!empty($data['cookie']) && !empty($data['base'])) {
    $rooms = $api->getChatRoom();
}

?>
	</div>

	<div class="col-md-9">
		<table class="table table-bordered">
			<tr>
				<th>群组</th>
				<th>信息</th>
			</tr>
			<?php foreach($rooms as $room):?>
			<tr>
				<td><?=$room['NickName']?></td>
				<td><?=Json::encode($room)?></td>
			</tr>
			<?php endforeach;?>
		</table>
	</div>
</div>
<?php

?>
