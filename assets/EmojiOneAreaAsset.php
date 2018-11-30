<?php
namespace app\assets;

use yii\web\AssetBundle;

class EmojiOneAreaAsset extends AssetBundle
{
    public $baseUrl = '@web/emojionearea';
    
    public $js = [
        'emojione.min.js',
        'jquery.textcomplete.min.js',
        'emojionearea.min.js',
    ];
    
    public $css = [
        'extras/css/emojione.min.css',
        'emojionearea.min.css',
        'emojionearea.min.css',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

