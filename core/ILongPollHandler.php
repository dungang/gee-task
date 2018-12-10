<?php
namespace app\core;

/**
 * Comet 处理接口
 *
 * @author dungang
 *        
 */
interface ILongPollHandler
{

    /**
     * 返回json字符串 或者 true（表示终止服务连接）
     *
     * @return string | boolean
     */
    public function process();
}

