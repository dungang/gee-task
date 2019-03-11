<?php
namespace app\core;

use yii\web\Response;

class LoopResponse extends Response
{
    /**
     * 业务处理句柄，不同业务使用不同的句柄实现类
     *
     * @var ILongPollHandler
     */
    public $handler;
    
    public $sleepTime = 6;
    
    
    protected function prepare(){
        \Yii::$app->getSession()->close();
    }
    
    /**
     * Sends the response content to the client.
     */
    protected function sendContent()
    {
        set_time_limit(0);
        ignore_user_abort(true);
        while(true) {
            \Yii::$app->db->close();
            sleep($this->sleepTime);
            \Yii::$app->db->open();
            flush();//No new orders, flush to notify php still alive
            if ($this->handler->process()) {
                flush();
                break;
            }
        }
    }
}

