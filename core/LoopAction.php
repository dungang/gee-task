<?php
namespace app\core;

use yii\base\Action;

class LoopAction extends Action
{

    public $debug = false;

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
    protected $handler;

    public $beforeRunCallback = null;

    protected function beforeRun()
    {
        if ($this->beforeRunCallback) {
            return call_user_func($this->beforeRunCallback);
        }
        return true;
    }

    public function init()
    {
        $this->handler = \Yii::createObject([
            'class' => $this->longPollingHandlerClass,
            'debug' => $this->debug
        ]);
    }

    public function run()
    {
        return \Yii::createObject([
            'class' => LoopResponse::className(),
            'sleepTime' => $this->sleepTimeSeconds,
            'handler' => $this->handler
        ]);
    }
}

