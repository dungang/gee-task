<?php
namespace app\assets;

use yii\web\AssetBundle;

class TimelineAsset extends AssetBundle
{
    public $baseUrl = '@web/timeline';
    
    public $js = [
        'js/timeline.min.js',
    ];
    
    public $css = [
        'css/timeline.min.css',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

