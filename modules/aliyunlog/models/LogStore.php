<?php
namespace modules\aliyunlog\models;

use yii\base\Model;

class LogStore extends Model
{
    public $logstoreName;
    
    public $projectName;
    
    public $ttl;
    
    public $shardCount;
    
    public $createTime;
    
    public $lastModifyTime;
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'logstoreName' => '日志库',
            'projectName' => '日志项目',
            'ttl' => 'ttl',
            'shardCount' => '分区数',
            'createTime' => '添加时间',
            'lastModifyTime' => '更新时间',
        ];
    }
}

