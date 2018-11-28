<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_event_handler".
 *
 * @property int $id
 * @property int $event_id 事件
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property string $handler 处理器
 * @property string $intro 介绍
 */
class EventHandler extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_event_handler';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'created_at', 'updated_at', 'name', 'handler'], 'required'],
            [['event_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['handler'], 'string', 'max' => 128],
            [['intro'], 'string', 'max' => 255],
            [['handler'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => '事件',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '名称',
            'handler' => '处理器',
            'intro' => '介绍',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventHandlerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventHandlerQuery(get_called_class());
    }
}
