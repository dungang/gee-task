<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\grid\TreeGrid;
use app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model app\models\AuthRole */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色授权: ' . $model->name;
$this->params['breadcrumbs'][] = [
    'label' => '角色',
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->name,
    'url' => [
        'view',
        'id' => $model->name
    ]
];
$this->params['breadcrumbs'][] = '授权';
?>
<div class="auth-role-permissions">

	<h1><?= Html::encode($this->title) ?></h1>
	 <?php ActiveForm::begin(); ?>
        <?php

        echo TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'name',
            'parentColumnName' => 'parent',
            'columns' => [
                [
                    'attribute' => 'name',
                    'label' => '名称',
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $column) use ($rights) {
                        if ($model['type'] == AuthItem::TYPE_PERMISSION) {
                            $checkbox = Html::checkbox('permission[]', in_array($model['name'], $rights), [
                                'value' => $model['name']
                            ]);
                            return $checkbox . $model['name'];
                        } else {
                            return $model['description'];
                        }
                    }
                ],
                [
                    'attribute' => 'description',
                    'label' => '描述',
                    'format' => 'ntext',
                    'value' => function ($model, $key, $index, $column) {
                        return $model['type'] == AuthItem::TYPE_PERMISSION ? $model['description'] : '';
                    }
                ],
                [
                    'attribute' => 'rule_name',
                    'label' => '规则',
                    'value' => function ($model, $key, $index, $column) {
                        return $model['type'] == AuthItem::TYPE_PERMISSION ? $model['rule_name'] : '';
                    }
                ]
            ]
        ]);
        ?>
    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
