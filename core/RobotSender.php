<?php
namespace app\core;

interface RobotSender
{
    public function sendMessage($title,$msg);
}

