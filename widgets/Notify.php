<?php
namespace app\widgets;

use yii\base\Widget;
use app\assets\NotifyAsset;
use yii\helpers\Json;

class Notify extends Widget
{
    public $msg;
    
    /**
     * success,info,error,warning
     * @var string
     */
    public $type = 'success';
    
    /**
     * center left right 
     * @var string
     */
    public $position = 'center';
    
//     public $width;
    
//     public $height;
    
    public $autohide = true;
    
    public $opacity = 1;
    
    public $multiline = true;
    
    public $clickable = false;
    
    public $timeout = 2000;
    
    
    public function run(){
        NotifyAsset::register($this->view);
        if(empty($this->msg)) {
            $this->msg = \Yii::$app->session->getFlash("notify",null,true);
        }
        if(empty($this->msg)) {
            return false;
        }
        $options = [
            'msg'=>$this->msg,
            'type'=>$this->type,
            'position'=>$this->position,
//             'width'=>$this->width,
//             'height'=>$this->height,
            'autohide'=>$this->autohide,
            'opacity'=>$this->opacity,
            'multiline'=>$this->multiline,
            'clickable'=>$this->clickable,
            'timeout'=>$this->timeout
        ];
        
        $js = "notif(".Json::htmlEncode($options).")";
        $this->view->registerJs($js);
    }
}

