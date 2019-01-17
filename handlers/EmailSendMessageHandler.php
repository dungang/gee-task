<?php
namespace app\handlers;

use app\core\CustomEventHandler;
use app\models\Setting;

abstract class EmailSendMessageHandler implements CustomEventHandler
{

    /**
     * 获取本次要发送的消息
     * 子类需要实现的方法
     *
     * @param mixed $data
     * @return array [emails,title,body]
     */
    protected abstract function getMessage($data);

    public function process($data)
    {
        if ($this->emailAbled()) {
            list ($emails, $title, $body) = $this->getMessage($data);
            if ($emails && $title && $body) {
                \Yii::$app->mailer->compose()
                ->setTo($emails)
                ->setFrom([
                    Setting::getSettings('email.username') => Setting::getSettings('email.useralias')
                ])
                ->setSubject($title)
                ->setHtmlBody($body)
                ->send();
            }
        }
       
    }

    protected function emailAbled()
    {
        if (Setting::getSettings('email.host') 
            && Setting::getSettings('email.username') 
            && Setting::getSettings('email.password') 
            && Setting::getSettings('email.port')) {
            return true;
        } else {
            return false;
        }
    }
}

