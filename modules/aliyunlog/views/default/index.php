<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var */
$this->title = "阿里云日志";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project">
	<p style="margin-top: 60px;">
        <?= Html::a('设置参数', ['setting'], ['class' => 'btn btn-success','data-toggle'=>'modal','data-target'=>'#modal-dailog']) ?>
    </p>
	    <?php

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'projectName',
            'description:ntext',
            'status',
            'region',
            'createTime:date',
            [
                'label' => '日志库',
                'format' => 'raw',
                'value' => function ($model, $key, $index, $column) {
                    return Html::a('查看', [
                        '/aliyun-log/store/index',
                        'projectName' => $model['projectName']
                    ]);
                }
            ]
        ]
    ]);
    ?>
</div>