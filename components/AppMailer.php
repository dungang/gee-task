<?php
namespace app\components;

use yii\swiftmailer\Mailer;
use app\models\Setting;

class AppMailer extends Mailer
{

    /**
     * 通过系统配置获取邮件的服务账号密码
     *
     * {@inheritdoc}
     * @see \yii\base\BaseObject::init()
     */
    public function init()
    {
        $this->useFileTransport = false;
        $this->transport = [
            'class' => 'Swift_SmtpTransport',
            'host' => Setting::getSettings('email.host'),
            'username' => Setting::getSettings('email.username'),
            'password' => Setting::getSettings('email.password'),
            'port' => Setting::getSettings('email.port')
        ];
    }
}

