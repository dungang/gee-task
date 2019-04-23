<?php
namespace app\core;

use yii\web\Response;

class LongPollResponse extends Response
{

    /**
     * 业务处理句柄，不同业务使用不同的句柄实现类
     *
     * @var ILongPollHandler
     */
    public $handler;

    public $timeout = 25;

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
        $endTime = time() + $this->timeout;

        do {
            sleep($this->sleepTime);
            $this->checkDbConnection();
            flush();//No new orders, flush to notify php still alive
            if ($data = $this->handler->process()) {
                echo $data;
                flush();
                break;
            }
        } while (time() < $endTime);
    }
    
    /**
     * 检查数据库是否正常，如果已经关闭则重新打开
     */
    protected function checkDbConnection()
    {
        if (! \Yii::$app->db->isActive) {
            \Yii::$app->db->open();
        }
    }
}

