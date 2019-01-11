<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\DatePicker;
use app\widgets\EmojiOneArea;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model modules\meet\models\Meet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meet-form">

    <?php $form = ActiveForm::begin(['id'=>'meet-form','enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'meet_date')->widget(DatePicker::className()) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'meet-title']) ?>
    
    <?= $form->field($model, 'actors')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'content')->widget('app\widgets\WangEditor',[
        'clientOptions'=>[
            'uploadImgServer'=>Url::to(['/attachment/wang-editor']),
            'menus'=>[
                'head',  // 标题
                'bold',  // 粗体
                'list',  // 列表
                'underline',  // 下划线
                'foreColor',  // 文字颜色
                'link',  // 插入链接
                'code',  // 插入代码
                'image',  // 插入图片   
                'video',  // 插入视频
                'emoticon',  // 表情
            ]
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php

    ActiveForm::end();
    EmojiOneArea::widget([
        'id' => 'meet-title'
    ]);
    ?>

</div>
