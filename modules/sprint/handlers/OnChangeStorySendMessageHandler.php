<?php
namespace modules\sprint\handlers;

use modules\robot\handlers\RobotSendMessageHandler;
use app\models\User;
use app\models\StoryStatus;

class OnChangeStorySendMessageHandler extends RobotSendMessageHandler
{
    public function init(){
        $this->msg_code = 'OnChangeStoryInSprint';
    }

    protected function getMessage($data)
    {
        /* @var $user \app\models\User */
        $user = \Yii::$app->user->identity;
        $active = self::$models['story-active'];
        $proccesor = User::findOne(['id'=>$data->user_id]);
        $status = StoryStatus::allIdToName();
        $tmpl = $this->getMsgTmpl();
        
        $vars = [];
        $vars['{user.nick_name}'] = $user->nick_name;
        $vars['{story.id}'] = $data->id;
        $vars['{story.user}'] = $proccesor->nick_name;
        $vars['{story.old_status}'] = $status[$active->old_status];
        $vars['{story.status}'] = $status[$data['status']];
        $vars['{story.name}'] = $data->name;
        $vars['{story.remark}'] = $active->remark;
        $title = strtr($tmpl->msg_subject, $vars);
        $body = strtr($tmpl->msg_body,$vars);
        return [
            $title,
            str_replace(array("\n", "\r\n"),"\n\n",$body)
        ];
    }
}

