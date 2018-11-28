<?php
namespace app\core;

interface RobotSender
{
    /**
     * 发送消息
     *
     * @param string $msg
     * @param boolean|array $atMobiles
     * @param boolean $isAll
     */
    public function sendMessage($title,$msg,$mobiles);
}

