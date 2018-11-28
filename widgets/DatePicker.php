<?php
namespace app\widgets;

use app\assets\DatePickerAsset;
use yii\bootstrap\InputWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * 日期选择控件
 * @author dungang
 *
 */
class DatePicker extends InputWidget
{
    public $embed = false;
    
    public $format = 'yyyy-mm-dd';
    
    public function init()
    {
        parent::init();
        $this->options['class'] = 'form-control';
    }
    
    public function run(){
        $this->clientOptions = ArrayHelper::merge([
            'autoclose'=>true,
            'zIndexOffset'=>10000,
            'todayBtn'=>'linked',
            'todayHighlight'=>true,
            'clearBtn'=>true,
        ],$this->clientOptions);
        $this->clientOptions['language'] = \Yii::$app->language;
        $this->clientOptions['format'] = $this->format;
        DatePickerAsset::register($this->view);
        $this->registerPlugin('datepicker');
        if ($this->embed == false) {
            if ($this->hasModel()) {
                return Html::activeTextInput($this->model, $this->attribute, $this->options);
            } else {
                return Html::textInput($this->id, $this->value, $this->options);
            }
        } else {
            return Html::tag('div','',$this->options);
        }
    }
}

