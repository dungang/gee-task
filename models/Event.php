<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_event".
 *
 * @property int $id
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property string $code 编码
 * @property string $intro 介绍
 */
class Event extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'name', 'code'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'code'], 'string', 'max' => 64],
            [['intro'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '名称',
            'code' => '编码',
            'intro' => '介绍',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EventQuery(get_called_class());
    }
}
