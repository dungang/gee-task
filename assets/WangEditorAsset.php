<?php
namespace app\assets;

use yii\web\AssetBundle;

/**
 * wangeditor
 * <link>http://www.wangeditor.com</link>
 * @author dungang
 *
 */
class WangEditorAsset extends AssetBundle
{
    public $baseUrl = '@web/wang-editor';
    
    public $js = [
        'wangEditor.min.js',
    ];
    
    public $css = [
        'wangEditor.min.css',
    ];
    
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

