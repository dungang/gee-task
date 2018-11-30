<?php

namespace modules\sprint\models;

use Yii;

/**
 * This is the model class for table "gt_story_acceptance".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property int $story_id 故事
 * @property int $creator_id 处理人
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $acceptance 接受项
 */
class StoryAcceptance extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_story_acceptance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'story_id'], 'required'],
            [['project_id', 'story_id', 'creator_id', 'created_at', 'updated_at'], 'integer'],
            [['acceptance'], 'string', 'max' => 128],
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
            'story_id' => '故事',
            'creator_id' => '处理人',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'acceptance' => '接受项',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StoryAcceptanceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoryAcceptanceQuery(get_called_class());
    }
}
