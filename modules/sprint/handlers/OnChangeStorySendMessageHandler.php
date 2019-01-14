<?php
namespace modules\sprint\handlers;

use modules\robot\handlers\RobotSendMessageHandler;
use app\models\User;
use app\models\StoryStatus;

class OnChangeStorySendMessageHandler extends RobotSendMessageHandler
{

    public function init()
    {
        $this->msg_code = 'OnChangeStoryInSprint';
    }

    protected function getMessage($data)
    {
        if ($tmpl = $this->getMsgTmpl()) {
            /* @var $user \app\models\User */
            $proccesor = User::findOne([
                'id' => $data->user_id
            ]);
            $status = StoryStatus::allIdToName();

            $vars = [];
            if(\Yii::$app->user && ($user = \Yii::$app->user->identity)){
                $vars['{user.nick_name}'] = $user->nick_name;
            } else {
                $vars['{user.nick_name}'] = '系统';
            }
            $vars['{story.id}'] = $data->id;
            $vars['{story.user}'] = $proccesor->nick_name;
           
            if ($active = isset(self::$models['story-active'])?self::$models['story-active']:false) {
                $vars['{story.old_status}'] = $status[$active->old_status];
                $vars['{story.remark}'] = $active->remark;
            } else {
                $vars['{story.old_status}'] = '';
                $vars['{story.remark}'] = '';
            }
            $vars['{story.status}'] = $status[$data['status']];
            $vars['{story.name}'] = $data->name;
            $title = strtr($tmpl->msg_subject, $vars);
            $body = strtr($tmpl->msg_body, $vars);
            return [
                $title,
                str_replace(array(
                    "\n",
                    "\r\n"
                ), "\n\n", $body)
            ];
        }
        return [
            false,
            false
        ];
    }
}

