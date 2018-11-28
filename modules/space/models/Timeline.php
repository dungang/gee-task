<?php

namespace modules\space\models;

use Yii;

/**
 * This is the model class for table "gt_timeline".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property string $title 名称
 * @property string $description 说明
 */
class Timeline extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_timeline';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'title'], 'required'],
            [['project_id'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['description'], 'string', 'max' => 255],
            [['title'], 'unique'],
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
            'title' => '名称',
            'description' => '说明',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TimelineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TimelineQuery(get_called_class());
    }
}
