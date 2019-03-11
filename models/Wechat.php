<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_wechat".
 *
 * @property int $id
 * @property int $user_id 管理员
 * @property string $name 名称
 * @property string $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $traced_at 跟踪时间
 * @property string $data 数据
 */
class Wechat extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_wechat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'traced_at'], 'integer'],
            [['status', 'data'], 'string'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '管理员',
            'name' => '名称',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'traced_at' => '跟踪时间',
            'data' => '数据',
        ];
    }

    /**
     * {@inheritdoc}
     * @return WechatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WechatQuery(get_called_class());
    }
}
