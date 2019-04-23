<?php
namespace app\controllers;

use app\helpers\CrontabHelpers;

/**
 * WechatController implements the CRUD actions for Wechat model.
 */
class WechatController extends AdminController
{

    const CRON_NAME = 'wechat';

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
                'class' => '\app\core\LoopAction',
                'beforeRunCallback' => [
                    $this,
                    'canStartCronProcess'
                ],
                'debug' => false,
                'longPollingHandlerClass' => '\app\webchat\LoopHandler'
            ]
        ];
    }

    /**
     * 切换定时任务服务状态
     *
     * @return mixed|number[]|string[]
     */
    public function actionSwitchService()
    {
        if (CrontabHelpers::getCronStatus(self::CRON_NAME)) {
            CrontabHelpers::unactiveCronStatus(self::CRON_NAME);
        } else {
            CrontabHelpers::activeCronStatus(self::CRON_NAME);
        }
        return $this->redirectOnSuccess([
            'index'
        ]);
    }

    /**
     * 处理定时器的可执行状态
     *
     * @return callable
     */
    public function canStartCronProcess()
    {
        list ($status, $traced_at) = CrontabHelpers::prepareCronSetting(self::CRON_NAME);
        if ($status > 1) {
            CrontabHelpers::tracedCron(self::CRON_NAME);
            //表示没有cron进程在运行，需要重新启动，如果超过1800秒【半小时】没更新时间，也重新启动
            if (empty($traced_at) || intval($traced_at) + 1800 < time()) {
                return true;
            }
        }
        return false;
    }
}
