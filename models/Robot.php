<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_robot".
 *
 * @property int $id
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property string $code_full_class 代码类
 */
class Robot extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_robot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['code_full_class'], 'string', 'max' => 128],
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
            'code_full_class' => '代码类',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RobotQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RobotQuery(get_called_class());
    }
}
