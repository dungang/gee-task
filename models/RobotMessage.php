<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_robot_message".
 *
 * @property int $id
 * @property string $code 消息代号
 * @property string $name 消息名称
 * @property string $msg_subject 消息主题
 * @property string $subject_vars 主题变量
 * @property string $msg_body 消息内容
 * @property string $body_vars 内容变量
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
            [['msg_body'], 'string'],
            [['code', 'name'], 'string', 'max' => 64],
            [['msg_subject', 'subject_vars', 'body_vars'], 'string', 'max' => 255],
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
            'msg_subject' => '消息主题',
            'subject_vars' => '主题变量',
            'msg_body' => '消息内容',
            'body_vars' => '内容变量',
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
