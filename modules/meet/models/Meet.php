<?php

namespace modules\meet\models;

use Yii;

/**
 * This is the model class for table "gt_meet".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property string $actors 参会人
 * @property string $meet_date 日期
 * @property int $creator_id 记录人
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $title 议题
 * @property string $content 内容
 * @property int $is_del
 */
class Meet extends \app\core\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_meet';
    }
   

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'actors', 'meet_date', 'creator_id', 'created_at', 'updated_at', 'title', 'content'], 'required'],
            [['project_id', 'creator_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['actors', 'content'], 'string'],
            [['meet_date'], 'safe'],
            [['title'], 'string', 'max' => 128],
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
            'actors' => '参会人',
            'meet_date' => '日期',
            'creator_id' => '记录人',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'title' => '议题',
            'content' => '内容',
            'is_del' => 'Is Del',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MeetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MeetQuery(get_called_class());
    }
}
