<?php
namespace modules\aliyunlog\models;
use yii\base\Model;

/**
 * 日志项目
 * @author dungang
 *
 */
class Project extends Model
{
    public $projectName;
    public $description;
    public $region;
    public $owner;
    public $status;
    public $createTime;
    public $lastModifyTime;
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projectName', 'description'], 'required'],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'projectName' => '项目',
            'description' => '介绍',
            'region' => '区域',
            'owner' => '所有者',
            'status' => '状态',
            'createTime' => '添加时间',
            'lastModifyTime' => '更新时间',
        ];
    }
    
}

