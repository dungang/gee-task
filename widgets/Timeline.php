<?php
namespace app\widgets;

use yii\bootstrap\Widget;
use app\assets\TimelineAsset;

class Timeline extends Widget
{

    public $forceVerticalMode = 400;

    public $mode = 'horizontal';

    public $visibleItems = 4;

    public $size = 0;

    public function run()
    {
        if($this->size == 0) {
            return '';
        }
        TimelineAsset::register($this->view);
        $this->clientOptions['forceVerticalMode'] = $this->forceVerticalMode;
        $this->clientOptions['mode'] = $this->mode;
        $this->clientOptions['visibleItems'] = $this->visibleItems > $this->size ? $this->size : $this->visibleItems;
        $this->registerPlugin('timeline');
    }
}

