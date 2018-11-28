<?php
namespace app\assets;

use yii\web\AssetBundle;

class ZClipAsset extends AssetBundle
{

    public $baseUrl = '@web';

    public $js = [
        'js/jquery.zclip.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

