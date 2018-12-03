<?php
namespace modules\aliyunlog\models;

use yii\base\Model;

class Query extends Model
{
    /**
     * 项目名称
     * @var string
     */
    public $projectName;
    
    /**
     * 日志库
     * @var string
     */
    public $logstoreName;
    
    
    /**
     * 日志主题
     * @var string
     */
    public $topic;
    
    /**
     * 从现在的时间
     * @var string
     */
    public $from;
    
    /**
     * 到过去的时间
     * @var string
     */
    public $to;
    
    /**
     * 查询语句
     * @var string
     */
    public $query;
    
    /**
     * 显示行数
     * @var number
     */
    public $line = 100;
    
    /**
     * 偏移行数
     * @var number
     */
    public $offset = 0;
    
    /**
     * 排序方向
     * @var bool
     */
    public $reverse = true;
    
    
    public function init(){
        
        if (empty($this->from) or empty($this->to)) {
            $today = date('Y-m-d 00:00:00');
            $this->from = $today;
            $this->to = date('Y-m-d 00:00:00', strtotime($today . " +1   day"));
        }
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projectName', 'logstoreName', 'topic', 'from','to','query'], 'safe'],
            [['line', 'offset','reverse'], 'integer'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectName'=>'日志项目',
            'logstoreName'=>'日志库',
            'topic'=>'日志主题',
            'from'=>'起始时间',
            'to' => '结束时间',
            'query' => '查询语句',
            'line' => '显示行数',
            'offset' => '偏移行数',
            'reverse' => '倒序',
        ];
    }
}

