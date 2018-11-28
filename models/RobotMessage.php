<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_robot_message".
 *
 * @property int $id
 * @property string $code 消息代号
 * @property string $name 消息名称
 * @property string $message 消息模板
 */
class RobotMessage extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_robot_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['robot_id'], 'required'],
            [['robot_id'], 'integer'],
            [['code', 'name'], 'string', 'max' => 64],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => '消息代号',
            'name' => '消息名称',
            'message' => '消息模板',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RobotMessageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RobotMessageQuery(get_called_class());
    }
}
