<?php
namespace modules\aliyunlog\controllers;

use app\controllers\AppController;
use modules\aliyunlog\models\AliyunLog;
use app\helpers\MiscHelper;

/**
 * 阿里云日志服务api的base controller
 * @author dungang
 *
 */
abstract class LogController extends AppController
{
    /**
     * 获取阿里云的 log 客户端
     * @return \Aliyun_Log_Client
     */
    public function getLogClient(){
        if($log = AliyunLog::findOne(['project_id'=>MiscHelper::getProjectId()])) {
            return new \Aliyun_Log_Client($log->endpoint, $log->access_key, $log->secret_key);
        }
        return false;
    }
}

