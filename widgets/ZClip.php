<?php
namespace app\widgets;

use yii\bootstrap\Widget;
use yii\web\JsExpression;
use app\assets\ZClipAsset;
use yii\helpers\Url;

class ZClip extends Widget
{
    public $valId = '#val-id';
    
    public function run(){
        ZClipAsset::register($this->getView());
        $this->clientOptions['path']=Url::to('@web/js/ZeroClipboard.swf');
        $this->clientOptions['copy'] = new JsExpression("function(){
            return $('".$this->valId."').val();
        }");
        $this->registerPlugin("zclip");
    }
}

