<?php
namespace app\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\View;

/**
 * 背景视频
 *
 * @author dungang
 *        
 */
class BackgroundVideo extends Widget
{

    public $id = 'bgvideo';

    public $video = '';

    public $image = '';

    public function run()
    {
        $this->getView()->registerCss($this->bgCss($this->id, $this->image));
        $this->getView()->on(View::EVENT_END_BODY, [
            $this,
            'renderVido'
        ]);
    }

    public function renderVido()
    {
        $source = Html::tag('source', '', [
            'src' => $this->video,
            'type' => 'video/mp4'
        ]);
        echo Html::tag('video', $source, [
            'id' => $this->id,
            'loop' => true,
            'muted' => true,
            'poster' => $this->image,
            'autoplay' => 'autoplay'
        ]);
    }

    protected function bgCss($selector, $image_url)
    {
        return <<<CSS
.navbar-default,
.navbar-inverse,
.navbar-inverse .navbar-nav>.active>a,
.footer {
    border-color: transparent;
    background-color: transparent;
    color:white;
}

#${selector} {
    position: fixed; 
    right: 0; 
    bottom: 0; 
    min-width: 100%; min-height: 100%; 
    width: auto; 
    height: auto; 
    z-index: -100; 
    background: url($image_url) no-repeat; 
    background-size: cover;
} 
CSS;
    }
}

