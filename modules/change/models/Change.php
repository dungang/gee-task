<?php

namespace modules\change\models;

use Yii;

/**
 * This is the model class for table "gt_change".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property int $category_id 分类
 * @property int $creator_id 创建人
 * @property string $content 内容
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class Change extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_change';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'category_id', 'creator_id'], 'required'],
            [['project_id', 'category_id', 'creator_id', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => '项目',
            'category_id' => '分类',
            'creator_id' => '创建人',
            'content' => '内容',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ChangeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChangeQuery(get_called_class());
    }
}
