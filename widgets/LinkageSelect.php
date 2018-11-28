<?php
namespace app\widgets;

use yii\base\Widget;

class LinkageSelect extends Widget
{
    public function run(){
        $this->view->registerJs("$(document).linkageSelect()");
    }
}

