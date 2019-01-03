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
     *
     * @var string
     */
    public $type = 'success';
    
    /**
     * center left right
     *
     * @var string
     */
    public $position = 'center';
    
    // public $width;
    
    // public $height;
    public $autohide = true;
    
    public $opacity = 1;
    
    public $multiline = true;
    
    public $clickable = false;
    
    public $timeout = 2000;
    
    public $alertTypes = [
        'error' => 'alert-danger',
        'danger' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning'
    ];
    
    
    public function run()
    {
        NotifyAsset::register($this->view);
        $session = \Yii::$app->session;
        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $flash) {
            if (! isset($this->alertTypes[$type])) {
                continue;
            }
            
            foreach ((array) $flash as $i => $message) {
                $this->renderNotify($message);
            }
            
            $session->removeFlash($type);
        }
        
    }
    
    public function renderNotify($msg){
        $options = [
            'msg' => $msg,
            'type' => $this->type,
            'position' => $this->position,
            // 'width'=>$this->width,
            // 'height'=>$this->height,
            'autohide' => $this->autohide,
            'opacity' => $this->opacity,
            'multiline' => $this->multiline,
            'clickable' => $this->clickable,
            'timeout' => $this->timeout
        ];
        
        $js = "notif(" . Json::htmlEncode($options) . ")";
        $this->view->registerJs($js);
    }
}

