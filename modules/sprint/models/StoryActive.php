<?php

namespace modules\sprint\models;

use Yii;
use modules\robot\handlers\RobotSendMessageHandler;

/**
 * This is the model class for table "gt_story_active".
 *
 * @property int $id
 * @property int $project_id 项目
 * @property int $story_id 任务项
 * @property int $old_user 旧处理人
 * @property int $new_user 新处理人
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
            [['project_id', 'story_id', 'old_user', 'new_user', 'creator_id', 'created_at'], 'integer'],
            [['story_id', 'old_user', 'new_user', 'old_status', 'new_status'], 'required'],
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
            'project_id' => '项目',
            'story_id' => '任务项',
            'old_user' => '旧处理人',
            'new_user' => '处理人',
            'old_status' => '旧状态',
            'new_status' => '状态',
            'creator_id' => '更新人',
            'created_at' => '添加时间',
            'remark' => '备注',
        ];
    }
    
    public function init(){
        parent::init();
        RobotSendMessageHandler::addModelChain('story-active', $this);
        $this->on(self::EVENT_AFTER_INSERT,function($event){
            if($story = Story::findOne(['id'=>$this->story_id])){
                $story->status = $this->new_status;
                $story->user_id = $this->new_user;
                $story->save(false);
            }
        });
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
