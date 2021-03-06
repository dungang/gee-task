<?php
namespace modules\meet\handlers;

use modules\robot\handlers\RobotSendMessageHandler;
use modules\meet\models\Meet;
use yii\helpers\Url;

class OnSaveMeetingSendMessageHandler extends RobotSendMessageHandler
{

    /**
     * 发生会议结论消息
     * @param $data Meet
     * {@inheritdoc}
     * @see \modules\robot\handlers\RobotSendMessageHandler::getMessage()
     */
    protected function getMessage($data)
    {
        return [
            $data->title . '[' . $data->meet_date . ']',
            '[会议内容]('.Url::to(['/meet/default/view','id'=>$data->id],true).')'
        ];
    }
}

