<?php
namespace modules\sprint\handlers;

use modules\robot\handlers\RobotSendMessageHandler;

class OnCreateStorySendMessageHandler extends RobotSendMessageHandler
{

    protected function getMessage($data)
    {
        /* @var $user \app\models\User */
        $user = \Yii::$app->user->identity;
        $title = $user->username . '创建了一个新的故事';
        $body = '#'.$data['id'].'[' . $data['name'] . ']';
        return [
            $title,
            $body
        ];
    }
}

