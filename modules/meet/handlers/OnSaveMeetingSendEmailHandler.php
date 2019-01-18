<?php
namespace modules\meet\handlers;

use app\handlers\EmailSendMessageHandler;
use modules\meet\models\Meet;
use app\models\ProjectMember;
use app\models\User;

class OnSaveMeetingSendEmailHandler extends EmailSendMessageHandler
{

    /**
     * 发生会议结论消息
     *
     * @param $data Meet
     * {@inheritdoc}
     * @see \modules\robot\handlers\RobotSendMessageHandler::getMessage()
     */
    protected function getMessage($data)
    {
        $members = ProjectMember::find()->select("u.email")
            ->innerJoin([
            'u' => User::tableName()
        ], 'user_id = u.id')
            ->where([
            'project_id' => $data->project_id
        ])
            ->asArray()
            ->all();
        $emails = [];
        foreach ($members as $mem) {
            $emails[] = $mem['email'];
        }
        $body = '<table><tr><th><h1>' . $data->title . '</h1></th></tr>' 
                . '<tr><td><p><strong>参与人员：</strong>' . $data->actors . '</p></td></tr>' 
                . '<tr><td>' . $data->content . '</td></tr></table>';
        return [
            array_unique($emails),
            $data->title . '[' . $data->meet_date . ']',
            $body
        ];
    }
}