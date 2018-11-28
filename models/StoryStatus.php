<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gt_story_status".
 *
 * @property int $id
 * @property int $is_backlog 产品Backlog
 * @property string $name 名称
 * @property string $description 说明
 * @property int $sort 排序
 */
class StoryStatus extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_story_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_backlog','sort'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_backlog' => '产品Backlog',
            'name' => '名称',
            'description' => '说明',
            'sort' => '排序',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StoryStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoryStatusQuery(get_called_class());
    }
}
