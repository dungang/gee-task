<?php
namespace app\assets;

use yii\web\AssetBundle;

class EditableSelectAsset extends AssetBundle
{
    public $baseUrl = '@web/editable-select/dist';
    
    public $js = [
        'jquery-editable-select.min.js',
    ];
    
    public $css = [
        'jquery-editable-select.min.css',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

