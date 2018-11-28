<?php
namespace app\core;

use yii\base\Action;

class LongPollAction extends Action
{

    /**
     * 服务端循环间隔时间
     *
     * @var integer
     */
    public $timeoutSeconds = 25;

    /**
     * php线程睡眠间隔时间
     *
     * @var integer
     */
    public $sleepTimeSeconds = 2;

    /**
     * 句柄实现类
     *
     * @var string
     */
    public $longPollingHandlerClass = null;

    /**
     * 业务处理句柄，不同业务使用不同的句柄实现类
     *
     * @var ILongPollHandler
     */
    public $handler;

    public function init()
    {
        $this->handler = \Yii::createObject($this->longPollingHandlerClass);
    }

    public function run()
    {
        return \Yii::createObject([
            'class' => LongPollResponse::className(),
            'timeout' => $this->timeoutSeconds,
            'sleepTime' => $this->sleepTimeSeconds,
            'handler' => $this->handler
        ]);
    }
}

