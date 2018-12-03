<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\ListView;
use app\helpers\MiscHelper;
/* @var $this yii\web\View */
/* @var $searchModel \modules\aliyunlog\models\Query */

$projectName = $searchModel->projectName;
$logstoreName = $searchModel->logstoreName;
$this->title = $logstoreName . '@' . $projectName . "日志";
$this->params['breadcrumbs'][] = [
    'label' => '日志项目',
    'url' => [
        '/aliyun-log-project/index'
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $projectName,
    'url' => [
        '/aliyun-log-store/index',
        'projectName' => $projectName
    ]
];
$this->params['breadcrumbs'][] = $logstoreName;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project">
	<?php

$form = ActiveForm::begin([
    'method' => 'get',
    'options' => [
        'data-pjax' => 1
    ]
]);
?>
    <div class='row'>
		<div class='col-md-1'>
			<label>&nbsp;</label>
			<div class="form-group">
			<?= MiscHelper::goBackButton()?>
			</div>
		</div>
		<div class='col-md-2'>
    		<?= $form->field($searchModel, 'from')->input('datetime') ?>
    	</div>
		<div class='col-md-2'>
    		<?= $form->field($searchModel, 'to')->input('datetime') ?>
    	</div>
		<div class='col-md-2'>
        	<?= $form->field($searchModel, 'line')->dropDownList([100=>100,200=>200,500=>500]) ?>
		</div>
		<div class='col-md-4'>
    		<?= $form->field($searchModel, 'query') ?>
    	</div>
		<div class='col-md-1'>
			<label>&nbsp;</label>
			<div class="form-group">
    		<?= Html::submitButton('查询', ['class' => 'btn btn-primary btn-small']) ?>
			</div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
    <pre>
	    <?php

    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'itemView' => function ($model, $key, $index, $widget) {
            $msgs[] = date('Y-m-d H:i:s', $model['time']);
            $msgs[] = '[' . $model['level'] . ']';
            $msgs[] = $model['ip'];
            $msgs[] = $model['thread'];
            $msgs[] = $model['location'];
            $msgs[] = '<p  style="width:950px;overflow-x:hidden;">' . $model['message'] . '</p>';
            return implode(" ", $msgs);
        }
    ]);
    ?>
    </pre>
</div>