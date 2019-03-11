<?php
namespace app\backend\controllers;

use app\models\Setting;

/**
 * WechatController implements the CRUD actions for Wechat model.
 */
class WechatController extends BackendController
{

    public function actions()
    {
        $user_id = \Yii::$app->user->id;
        return [
            'index' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\WechatSearch'
                ]
            ],
            'my' => [
                'class' => 'app\core\ListModelsAction',
                'modelClass' => [
                    'class' => 'app\models\WechatSearch',
                    'user_id' => $user_id
                ]
            ],
            'create' => [
                'class' => 'app\core\CreateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Wechat',
                    'user_id' => $user_id
                ]
            ],
            'update' => [
                'class' => 'app\core\UpdateModelAction',
                'modelClass' => [
                    'class' => 'app\models\Wechat',
                    'user_id' => $user_id
                ]
            ],
            'view' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\Wechat',
                    'user_id' => $user_id
                ]
            ],
            'group' => [
                'class' => 'app\core\ViewModelAction',
                'modelClass' => [
                    'class' => 'app\models\Wechat',
                    'user_id' => $user_id
                ]
            ],
            'delete' => [
                'class' => 'app\core\DeleteModelAction',
                'modelClass' => [
                    'class' => 'app\models\Wechat',
                    'user_id' => $user_id
                ]
            ],
            'qr' => [
                'class' => 'app\webchat\QrAction'
            ],
            'login-check' => [
                'class' => 'app\core\LongPollAction',
                'longPollingHandlerClass' => '\app\webchat\ScanLoginHandler'
            ],
            'loop' => [
                'class' => 'app\core\LoopAction',
                'beforeRunCallback'=>$this->checkLoop(),
                'longPollingHandlerClass' => '\app\webchat\LoopHandler'
            ]
        ];
    }
    
    public function checkLoop(){
        return function(){
            if($trace = Setting::findOne([
                'name' => 'wechat.loop.traced_at'
            ])){
                if(empty($trace->value) || intval($trace->value) + 180 < time()) {
                    $trace->value = time();
                    $trace->save(false);
                    return true;
                }
            }
            return false;
        };
    }

    /**
     * 切换微信后台服务状态
     * @return mixed|number[]|string[]
     */
    public function actionSwitchService()
    {
        if($status = Setting::findOne([
            'name' => 'wechat.loop.status'
        ])){
            $status->value > 0 ? $status = 0 : $status->value = time();
            $status->save(false);
        }
        return $this->redirectOnSuccess(['index']);
    }
}
