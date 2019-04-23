<?php
namespace app\core;

use yii\base\BaseObject;

/**
 * Comet 处理接口
 *
 * @author dungang
 *        
 */
abstract class ILongPollHandler extends BaseObject
{

    public $debug = false;
    
    /**
     * 返回json字符串 或者 true（表示终止服务连接）
     * 如果不想终止则直接返回false
     *
     * @return string | bool
     */
    public abstract function process();
    
    /**
     * 调试模式不循环
     * @return boolean
     */
    public final function whenDebugNotLoop(){
        return $this->debug;
    }
}

