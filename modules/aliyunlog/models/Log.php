<?php
namespace modules\aliyunlog\models;

use yii\base\Model;

class Log extends Model
{
    public $time;
    
    public $topic;
    
    public $ip;
    
    public $level;
    
    public $location;
    
    public $message;
    
    public $throwable;
    
    public $thread;
    
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'topic'=>'主题',
            'time' => '时间',
            'ip' => 'IP',
            'level' => 'LEVEL',
            'location' => '异常位置',
            'message' => '消息',
            'throwable' => '异常',
            'thread' => '线程',
        ];
    }
}

