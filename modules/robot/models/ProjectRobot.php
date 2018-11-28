<?php

namespace modules\robot\models;

use Yii;

/**
 * This is the model class for table "gt_project_robot".
 *
 * @property int $id
 * @property int $robot_id 机器人
 * @property int $project_id 项目
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 机器人名称
 * @property string $webhook 通知地址
 */
class ProjectRobot extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_project_robot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['robot_id'], 'required'],
            [['robot_id', 'project_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['webhook'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'robot_id' => '机器人',
            'project_id' => '项目',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '机器人名称',
            'webhook' => '通知地址',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectRobotQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectRobotQuery(get_called_class());
    }
}
