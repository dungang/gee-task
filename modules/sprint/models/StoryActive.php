<?php

namespace modules\sprint\models;

use Yii;

/**
 * This is the model class for table "gt_store_active".
 *
 * @property int $id
 * @property int $story_id 任务项
 * @property string $old_status 旧状态
 * @property string $new_status 新状态
 * @property int $creator_id 处理人
 * @property int $created_at 添加时间
 * @property string $remark 备注
 */
class StoryActive extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_story_active';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['story_id', 'old_status', 'new_status', 'creator_id', 'created_at'], 'required'],
            [['story_id', 'creator_id', 'created_at'], 'integer'],
            [['old_status', 'new_status'], 'string', 'max' => 32],
            [['remark'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'story_id' => '任务项',
            'old_status' => '旧状态',
            'new_status' => '新状态',
            'creator_id' => '处理人',
            'created_at' => '添加时间',
            'remark' => '备注',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StoryActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoryActiveQuery(get_called_class());
    }
}
