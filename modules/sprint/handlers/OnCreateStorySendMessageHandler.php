<?php
namespace modules\sprint\handlers;

use modules\robot\handlers\RobotSendMessageHandler;
use app\models\User;

class OnCreateStorySendMessageHandler extends RobotSendMessageHandler
{

    public function init()
    {
        $this->msg_code = 'OnCreateStoryInSprint';
    }

    protected function getMessage($data)
    {
        if ($tmpl = $this->getMsgTmpl()) {
            /* @var $user \app\models\User */
            $proccesor = User::findOne([
                'id' => $data->user_id
            ]);
            $vars = [];
            if (\Yii::$app->user && ($user = \Yii::$app->user->identity)) {
                $vars['{user.nick_name}'] = $user->nick_name;
            } else {
                $vars['{user.nick_name}'] = '系统';
            }
            $vars['{story.id}'] = $data->id;
            $vars['{story.user}'] = $proccesor->nick_name;
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

