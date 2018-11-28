<?php
namespace app\assets;

use yii\web\AssetBundle;

class EChartAsset extends AssetBundle
{
    public $baseUrl = '@web/js';
    
    public $js = [
        'Chart.min.js',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

