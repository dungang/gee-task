<?php

namespace modules\sprint\models;

use Yii;

/**
 * This is the model class for table "gt_story".
 *
 * @property int $id
 * @property int $sprint_id 计划
 * @property string $story_type 类型
 * @property string $status 状态
 * @property int $important 优先程度
 * @property int $project_id 项目
 * @property int $user_id 处理人
 * @property int $last_user_id 更新者
 * @property int $creator_id 创建者
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 * @property string $name 名称
 * @property string $project_version 版本
 * @property int $is_del
 */
class Story extends \app\core\BaseModel
{
    
    public static $types = ['bug'=>'Bug','requirement'=>'需求'];
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gt_story';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sprint_id', 'status', 'project_id', 'user_id'], 'required'],
            [['sprint_id', 'important', 'project_id', 'user_id', 'last_user_id', 'creator_id', 'created_at', 'updated_at', 'is_del'], 'integer'],
            [['story_type', 'status', 'project_version'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sprint_id' => '计划',
            'story_type' => '类型',
            'status' => '状态',
            'important' => '优先程度',
            'project_id' => '项目',
            'user_id' => '处理人',
            'last_user_id' => '更新者',
            'creator_id' => '创建者',
            'created_at' => '添加时间',
            'updated_at' => '更新时间',
            'name' => '名称',
            'project_version' => '版本',
            'is_del' => 'Is Del',
        ];
    }
    
    public function behaviors(){
        $b = parent::behaviors();
        $b['onSaveEvent'] = [
            'class'=>'app\behaviors\TriggerCustomEventOnSave',
            'customEventName'=>'sprint.assgin.task',
        ];
        return $b;
    }

    /**
     * {@inheritdoc}
     * @return StoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoryQuery(get_called_class());
    }
}
