<?php
namespace modules\aliyunlog\models;

/**
 * 获取日期相关数据的查询接口类
 * @author dungang
 *
 */
abstract class DataSearch extends Query
{
    public $key;
    
    /**
     * 获取阿里云的 log 客户端
     * @var \Aliyun_Log_Client
     */
    public $client;
    
    private $models;
    
    private $count;
    
    /**
     * 请求的参数
     * @param array $param
     */
    public abstract function search($param);
    
    /**
     * 获取模型的总条数
     */
    public abstract function getCount();
    
    /**
     * 获取模型
     */
    public abstract function getModels();
    
}

