<?php

namespace modules\sprint\models;

use Yii;

/**
 * This is the model class for table "gt_story_attachment".
 *
 * @property string $id ID
 * @property string $story_id 故事
 * @property string $user_id 用户
 * @property string $path 物理路径
 * @property string $mimetype mime类型
 * @property string $created_at 创建日期
 * @property string $updated_at 更新时间
 */
class StoryAttachment extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_story_attachment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['story_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['mimetype'], 'string', 'max' => 64],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'story_id' => '故事',
            'user_id' => '用户',
            'path' => '物理路径',
            'mimetype' => 'mime类型',
            'created_at' => '创建日期',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StoryAttachmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoryAttachmentQuery(get_called_class());
    }
}
