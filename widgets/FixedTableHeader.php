<?php
namespace app\widgets;

use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

/**
 * 固定表格的头部
 * @author dungang
 *
 */
class FixedTableHeader extends Widget
{
    
    public function init(){
        $defClientOptions = [
            'offset'=>[
                'top'=>'300',
                'bottom'=>'100'
            ]
        ];
        $this->clientOptions = ArrayHelper::merge($defClientOptions, $this->clientOptions);
    }
    
    public function run(){
        $this->registerPlugin('affix');
    }
}
