<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * 日期选择控件资源文件
 * @author dungang
 *
 */
class DatePickerAsset extends AssetBundle
{
    public $baseUrl = '@web/date-picker';
    
    public $js = [
        'js/bootstrap-datepicker.min.js',
        'locales/bootstrap-datepicker.zh-CN.min.js',
    ];
    
    public $css = [
        'css/bootstrap-datepicker.min.css',
    ];
    
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}

