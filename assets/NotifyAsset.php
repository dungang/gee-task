<?php
namespace app\assets;

use yii\web\AssetBundle;

class NotifyAsset extends AssetBundle
{
    public $baseUrl = '@web/notifIt';
    
    public $js = [
        'js/notifIt.min.js',
    ];
    
    public $css = [
        'css/notifIt.min.css',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

