<?php
namespace app\webchat;

use yii\base\Action;

/**
 * 生成登录二维码
 *
 * @author dungang
 *        
 */
class QrAction extends Action
{
    public function run($uuid)
    {
        $api = new Api();
        return \Yii::$app->response->sendContentAsFile($api->getQrCode($uuid), "webchat-login-qr.png");
    }
}

